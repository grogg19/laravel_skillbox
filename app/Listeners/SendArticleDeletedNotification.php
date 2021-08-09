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
        Mail::to(config('admin_email.email'))->send(
            new \App\Mail\Articles\ArticleDeleted($event->article)
        );
    }
}
