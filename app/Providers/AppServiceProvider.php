<?php

namespace App\Providers;
use App\Repository\fiscalYear\FiscalYearInterface;
use App\Repository\fiscalYear\FiscalYearRepository;
use App\Repository\office\OfficeInterface;
use App\Repository\office\OfficeRepositroy;
use Illuminate\Pagination\Paginator;
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
        $this->app->bind(OfficeInterface::class,OfficeRepositroy::class);
        $this->app->bind(FiscalYearInterface::class,FiscalYearRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
