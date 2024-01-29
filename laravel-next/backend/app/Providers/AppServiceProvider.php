<?php

namespace App\Providers;

use App\Models\Category;
use App\View\Composers\CategoryComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

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
        Schema::defaultStringLength(191);
        // View::composer(['haber.haber-ekle'], function ($view) {
        //     $view->with('kategorilerOptions', Category::where('status', 1)->pluck('ad', 'id'));
        // });
        View::composer(['components.category-select'], CategoryComposer::class);
    }
}
