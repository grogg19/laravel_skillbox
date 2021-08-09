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
        Mail::to(config('admin_email.email'))->send(
            new \App\Mail\Articles\ArticleCreated($event->article)
        );
    }
}
