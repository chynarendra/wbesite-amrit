<?php

namespace App\Providers;

use App\Repository\appUserRepository\AppUserInterface;
use App\Repository\appUserRepository\AppUserLeaveInterface;
use App\Repository\appUserRepository\AppUserLeaveRepository;
use App\Repository\appUserRepository\AppUserRepository;
use App\Repository\dailySalesReport\DailySalesReportInterface;
use App\Repository\dailySalesReport\DailySalesReportInterfaceRepository;
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
        $this->app->bind(DailySalesReportInterface::class,DailySalesReportInterfaceRepository::class);
        $this->app->bind(OfficeInterface::class,OfficeRepositroy::class);
        $this->app->bind(AppUserInterface::class,AppUserRepository::class);
        $this->app->bind(AppUserLeaveInterface::class,AppUserLeaveRepository::class);
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
