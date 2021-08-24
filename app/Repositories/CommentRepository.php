<?php

namespace App\Repositories;

use App\Models\Article;

class CommentRepository implements CommentRepositoryInterface
{
    public function createComment(Article $article, $attributes)
    {
        $article->addComment($attributes);
    }
}
