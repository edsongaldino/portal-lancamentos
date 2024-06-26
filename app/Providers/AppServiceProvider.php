<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Builder;

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
        $this->app['request']->server->set('HTTPS', $this->app->environment() != 'local');

        Builder::macro('whereLike', function(string $attribute, string $searchTerm) {
           return $this->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
        });
    }
}
