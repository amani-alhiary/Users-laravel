<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);

        Route::macro('softDeletes', function ($resource, $controller) {
            Route::get("{$resource}/userstrashed", "{$controller}@userstrashed")->name("{$resource}.userstrashed");
            Route::patch("{$resource}/{id}/restore", "{$controller}@restore")->name("{$resource}.restore");
            Route::delete("{$resource}/{id}/delete", "{$controller}@delete")->name("{$resource}.delete");
        });
    }


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
