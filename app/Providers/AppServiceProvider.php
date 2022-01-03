<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $categories = Category::query()->withCount('products')->get();
            return $view->with([
                'categories' => $categories
            ]);
        });

        View::composer('landing', function ($view) {
            $landing_category = Category::query()
                ->withCount('products')
                ->latest()
                ->take(3)
                ->get();
            return $view->with([
                'landing_categories' => $landing_category
            ]);
        });
    }
}
