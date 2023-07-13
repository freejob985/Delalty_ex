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
         // product
        $this->app->bind(

'App\Interfaces\Front\ProductRepositoryInterface',
'App\Repositories\Front\ProductRepository',



        );
        // category
        $this->app->bind(
           
          
           'App\Interfaces\Front\CategoryRepositoryInterface',
           'App\Repositories\Front\CategoryRepository',
           
                   );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
