<?php

namespace App\Repositories;

use App\Models\Article;

interface CommentRepositoryInterface
{
    public function createComment(Article $article, $attributes);
}
