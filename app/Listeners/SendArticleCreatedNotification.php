<?php

namespace App\Listeners;

use App\Events\ArticleCreated;
use Illuminate\Support\Facades\Mail;

class SendArticleCreatedNotification
{
    /**
     * Handle the event.
     *
     * @param  ArticleCreated  $event
     * @return void
     */
    public function handle(ArticleCreated $event)
    {
        if(!empty(env('ADMIN_EMAIL'))) {
            Mail::to(env('ADMIN_EMAIL'))->send(
                new \App\Mail\Articles\ArticleCreated($event->article)
            );
        }
    }
}
