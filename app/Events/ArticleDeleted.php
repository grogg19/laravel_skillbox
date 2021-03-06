<?php

namespace App\Events;

use App\Models\Article;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ArticleDeleted
{
    use Dispatchable, SerializesModels;

    /**
     * @var Article
     */
    public $article;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }
}
