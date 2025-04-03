<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = NewsCategory::where('is_active', true)->get();

        if ($categories->isEmpty()) {
            $this->command->info('Сначала создайте категории! Запустите NewsCategorySeeder.');
            return;
        }

        $news = [
            [
                'title' => 'Поступили новые дизельные генераторы FG Wilson',
                'description' => 'В наличии новые модели дизельных генераторов мощностью от 10 до 200 кВт',
                'content' => $this->generateContent('дизельные генераторы'),
                'meta_title' => 'Купить дизельные генераторы FG Wilson | Каталог и цены',
                'meta_description' => 'Новые модели дизельных генераторов FG Wilson в наличии. Официальная гарантия, доставка по всей России.',
                'meta_keywords' => 'дизельные генераторы, fg wilson, купить генератор, цена генератора',
                'is_popular' => true,
                'is_banner' => true
            ],
            [
                'title' => 'Как продлить срок службы генератора',
                'description' => '5 основных правил эксплуатации генераторов',
                'content' => $this->generateContent('эксплуатация генераторов'),
                'meta_title' => 'Обслуживание генераторов - советы экспертов',
                'meta_description' => 'Рекомендации по увеличению срока службы дизельных и бензиновых генераторов. Профилактика неисправностей.',
                'meta_keywords' => 'обслуживание генераторов, срок службы, ремонт генераторов',
                'is_popular' => true
            ],
            [
                'title' => 'Специальное предложение на бензогенераторы',
                'description' => 'Скидки 15% на все бензиновые генераторы до конца месяца',
                'content' => $this->generateContent('акции на генераторы'),
                'meta_title' => 'Акция на бензиновые генераторы - скидки 15%',
                'meta_description' => 'Ограниченное предложение: скидки на бензогенераторы ведущих брендов. Только до конца месяца.',
                'meta_keywords' => 'бензогенераторы, акции, скидки на генераторы'
            ],
            [
                'title' => 'Зимнее хранение генераторов',
                'description' => 'Рекомендации по консервации оборудования на холодный период',
                'content' => $this->generateContent('хранение генераторов'),
                'meta_title' => 'Как хранить генератор зимой - правильная консервация',
                'meta_description' => 'Полное руководство по подготовке генератора к зимнему хранению. Советы от специалистов.',
                'meta_keywords' => 'хранение генератора, зимняя консервация, подготовка генератора'
            ],
            [
                'title' => 'Обзор новых инверторных генераторов',
                'description' => 'Преимущества инверторных технологий в генераторах',
                'content' => $this->generateContent('инверторные генераторы'),
                'meta_title' => 'Инверторные генераторы 2023 - обзор моделей',
                'meta_description' => 'Сравнение инверторных генераторов нового поколения. Технические характеристики и преимущества.',
                'meta_keywords' => 'инверторные генераторы, бесшумные генераторы, генераторы 2023',
                'is_popular' => true
            ]
        ];

        foreach ($news as $item) {
            News::create([
                'news_category_id' => $categories->random()->id,
                'title' => $item['title'],
                'description' => $item['description'],
                'content' => $item['content'],
                'meta_title' => $item['meta_title'],
                'meta_description' => $item['meta_description'],
                'meta_keywords' => $item['meta_keywords'],
                'image' => null,
                'is_active' => true,
                'is_popular' => $item['is_popular'] ?? false,
                'is_banner' => $item['is_banner'] ?? false,
            ]);
        }
    }

    protected function generateContent(string $topic): string
    {
        $content = [
            "Компания специализируется на продаже генераторов. Тема материала: {$topic}.",
            "Мы предлагаем только качественное оборудование от проверенных производителей.",
            "Наши специалисты помогут подобрать генератор под ваши задачи.",
            "Гарантия на все оборудование - от 2 лет. Сервисное обслуживание по всей России.",
            "Оставьте заявку на сайте или позвоните нам для консультации."
        ];

        return implode(" ", $content);
    }
}
