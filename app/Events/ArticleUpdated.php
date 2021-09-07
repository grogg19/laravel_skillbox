<?php

namespace App\Events;

use App\Models\Article;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ArticleUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Article
     */
    public $article;
    public $updatedFields;
    public $linkToArticle;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
        $this->updatedFields = 'Измененые поля: ' . implode(', ', $article->historyByPivot->last()->pivot->after);
        $this->linkToArticle = route('article.show', $article, false);

    }

    public function broadcastOn()
    {
        return new PrivateChannel('articles');
    }
}
