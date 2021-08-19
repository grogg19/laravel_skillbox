<?php

namespace App\Providers;

use App\Events\ArticleCreated;
use App\Events\ArticleDeleted;
use App\Events\ArticleUpdated;
use App\Listeners\SendArticleCreatedNotification;
use App\Listeners\SendArticleCreatedPushNotification;
use App\Listeners\SendArticleDeletedNotification;
use App\Listeners\SendArticleUpdatedNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ArticleCreated::class => [
            SendArticleCreatedNotification::class,
            SendArticleCreatedPushNotification::class
        ],
        ArticleUpdated::class => [
            SendArticleUpdatedNotification::class
        ],
        ArticleDeleted::class => [
          SendArticleDeletedNotification::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
