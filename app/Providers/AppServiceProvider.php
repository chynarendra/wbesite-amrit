<?php

namespace App\Providers;
use App\Repository\DispatchGeneral\DispatchGeneralInterface;
use App\Repository\DispatchGeneral\DispatchGeneralRepository;
use App\Repository\fiscalYear\FiscalYearInterface;
use App\Repository\fiscalYear\FiscalYearRepository;
use App\Repository\office\OfficeInterface;
use App\Repository\office\OfficeRepositroy;
use App\ViewComposers\HeaderComposer;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
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
        $this->app->bind(OfficeInterface::class,OfficeRepositroy::class);
        $this->app->bind(FiscalYearInterface::class,FiscalYearRepository::class);
        $this->app->bind(DispatchGeneralInterface::class,DispatchGeneralRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        View::composer(
            '*',HeaderComposer::class
           );
    }
}
