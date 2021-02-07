<?php

namespace App\Providers;

use App\Service\Production\ResultRepository;
use App\Service\Production\SurveyRepository;
use App\Service\ResultRepositoryInterface;
use App\Service\SurveyRepositoryInterface;
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
        $this->app->singleton(SurveyRepositoryInterface::class, SurveyRepository::class);
        $this->app->singleton(ResultRepositoryInterface::class,ResultRepository::class);
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
