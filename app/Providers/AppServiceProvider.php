<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ArticleRepositoryInterface;
use App\Repositories\ArticleRepository;
use App\Repositories\MessageRepositoryInterface;
use App\Repositories\MessageRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ArticleRepositoryInterface::class, ArticleRepository::class);
        $this->app->bind(MessageRepositoryInterface::class, MessageRepository::class);
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
