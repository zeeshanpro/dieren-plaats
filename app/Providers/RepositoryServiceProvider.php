<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register Interface and Repository in here
        // You must place Interface in first place
        // If you dont, the Repository will not get readed.
        $this->app->bind(
            'App\Interfaces\RaceInterface',
            'App\Repositories\RaceRepository'
        );

        $this->app->bind(
            'App\Interfaces\KindInterface',
            'App\Repositories\KindRepository'
        );

        $this->app->bind(
            'App\Interfaces\AdAttributeInterface',
            'App\Repositories\AdAttributeRepository'
        );

        $this->app->bind(
            'App\Interfaces\UserInterface',
            'App\Repositories\UserRepository'
        );

        $this->app->bind(
            'App\Interfaces\AdInterface',
            'App\Repositories\AdRepository'
        );

        $this->app->bind(
            'App\Interfaces\ExpectedBabieInterface',
            'App\Repositories\ExpectedBabieRepository'
        );

        $this->app->bind(
            'App\Interfaces\Front\UserInterface',
            'App\Repositories\Front\UserRepository'
        );

        $this->app->bind(
            'App\Interfaces\Front\AdInterface',
            'App\Repositories\Front\AdRepository'
        );

        $this->app->bind(
            'App\Interfaces\Front\kindInterface',
            'App\Repositories\Front\kindRepository'
        );

        $this->app->bind(
            'App\Interfaces\Front\BreederReviewInterface',
            'App\Repositories\Front\BreederReviewRepository'
        );

        $this->app->bind(
            'App\Interfaces\Front\ExpectedBabieInterface',
            'App\Repositories\Front\ExpectedBabieRepository'
        );

        $this->app->bind(
            'App\Interfaces\Front\MessageInterface',
            'App\Repositories\Front\MessageRepository'
        );
        
    }
}