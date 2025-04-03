<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class CurrencyService
{
    protected const MIN_RATE = 90;
    protected const CACHE_KEY = 'usd_to_rub_rate';
    protected const CACHE_TTL = 3600; // 1 час

    public function getUsdToRubRate(): float
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
            try {
                // Здесь можно использовать любое API для получения курса
                // Например, ЦБ РФ или другие открытые API
                $response = Http::get('https://www.cbr-xml-daily.ru/daily_json.js');

                if ($response->successful()) {
                    $data = $response->json();
                    $rate = $data['Valute']['USD']['Value'] ?? self::MIN_RATE;
                    return max($rate, self::MIN_RATE);
                }
            } catch (\Exception $e) {
                report($e);
            }

            return self::MIN_RATE;
        });
    }

    public function convertUsdToRub(float $usdAmount, bool $roundUp = true): int
    {
        $rate = $this->getUsdToRubRate();
        $rubAmount = $usdAmount * $rate;

        return $roundUp ? ceil($rubAmount / 100) * 100 : $rubAmount;
    }
}
