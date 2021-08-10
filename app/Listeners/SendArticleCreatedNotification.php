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
        if(!empty(config('admin.email'))) {
            Mail::to(config('admin.email'))->send(
                new \App\Mail\Articles\ArticleCreated($event->article)
            );
        }
    }
}
