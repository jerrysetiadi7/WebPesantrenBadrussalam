<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\kategoriModel as kategori;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('main-dakwah', function ($view) {
            $kategori = Kategori::all(); // atau where(...), sesuai kebutuhan
            $view->with('kategori', $kategori);
        });
    }
}
