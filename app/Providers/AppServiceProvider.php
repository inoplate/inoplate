<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['navigation']->register(require __DIR__ .'/../../navigations/institute.php');
        $this->app['navigation']->register(require __DIR__ .'/../../navigations/master.php');
        $this->app['navigation']->register(require __DIR__ .'/../../navigations/student.php');
        $this->app['navigation']->register(require __DIR__ .'/../../navigations/employee.php');
        $this->app['navigation']->register(require __DIR__ .'/../../navigations/academic.php');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
