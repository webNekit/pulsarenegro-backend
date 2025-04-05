<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
	{




        $this->loadViewsFrom(base_path('resources/views/website/main'), 'main');
        $this->loadViewsFrom(base_path('resources/views/website/news'), 'news');
        $this->loadViewsFrom(base_path('resources/views/website/calculator'), 'calculator');
        $this->loadViewsFrom(base_path('resources/views/website/faq'), 'faq');
        $this->loadViewsFrom(base_path('resources/views/website/product'), 'product');
        $this->loadViewsFrom(base_path('resources/views/website/wiki'), 'wiki');
    		$this->loadViewsFrom(base_path('resources/views/website/company'), 'company');
			$this->loadViewsFrom(base_path('resources/views/website/service'), 'service');
	}
}
