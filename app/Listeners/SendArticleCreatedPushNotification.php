<?php

namespace App\Listeners;

use App\Events\ArticleCreated;
use App\Services\PushAll;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendArticleCreatedPushNotification
{

    /**
     * @var PushAll
     */
    public $pushAll;

    /**
     * @param PushAll $pushAll
     */
    public function __construct(PushAll $pushAll)
    {
        $this->pushAll = $pushAll;
    }

    /**
     * Handle the event.
     *
     * @param ArticleCreated $event
     */
    public function handle(ArticleCreated $event)
    {
        $this->pushAll->send($event->article->title, $event->article->excerpt, route('article.show', $event->article));
    }
}
