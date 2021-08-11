<?php

namespace App\Listeners;

use App\Events\ArticleUpdated;
use Illuminate\Support\Facades\Mail;

class SendArticleUpdatedNotification
{
    /**
     * Handle the event.
     *
     * @param  ArticleUpdated  $event
     * @return void
     */
    public function handle(ArticleUpdated $event)
    {
        if(!empty(config('admin.email'))) {
            Mail::to(config('admin.email'))->send(
                new \App\Mail\Articles\ArticleUpdated($event->article)
            );
        }
    }
}
