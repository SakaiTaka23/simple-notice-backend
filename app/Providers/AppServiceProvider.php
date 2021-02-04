<?php

namespace App\Providers;

use App\Service\Production\SurveyRepository;
use App\Service\SurveyRepositoryInterface as ServiceSurveyRepositoryInterface;
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
        $this->app->singleton(ServiceSurveyRepositoryInterface::class, SurveyRepository::class);
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
