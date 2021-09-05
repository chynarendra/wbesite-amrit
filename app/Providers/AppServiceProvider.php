<?php

namespace App\Providers;

use App\Repository\appUserRepository\AppUserInterface;
use App\Repository\appUserRepository\AppUserRepository;
use App\Repository\dailySalesReport\DailySalesReportInterface;
use App\Repository\dailySalesReport\DailySalesReportInterfaceRepository;
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
