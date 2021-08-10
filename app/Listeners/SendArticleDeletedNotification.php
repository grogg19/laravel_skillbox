<?php

namespace App\Listeners;

use App\Events\ArticleDeleted;
use Illuminate\Support\Facades\Mail;

class SendArticleDeletedNotification
{
    /**
     * Handle the event.
     *
     * @param  ArticleDeleted  $event
     * @return void
     */
    public function handle(ArticleDeleted $event)
    {
        if(!empty(env('ADMIN_EMAIL'))) {
            Mail::to(env('ADMIN_EMAIL'))->send(
                new \App\Mail\Articles\ArticleDeleted($event->article)
            );
        }
    }
}
