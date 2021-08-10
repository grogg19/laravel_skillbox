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
        if(!empty(env('ADMIN_EMAIL'))) {
            Mail::to(env('ADMIN_EMAIL'))->send(
                new \App\Mail\Articles\ArticleUpdated($event->article)
            );
        }
    }
}
