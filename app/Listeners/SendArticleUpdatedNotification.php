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
        Mail::to(config('admin_email.email'))->send(
            new \App\Mail\Articles\ArticleUpdated($event->article)
        );
    }
}
