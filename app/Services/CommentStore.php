<?php

namespace App\Services;

use App\Http\Requests\Comments\StoreCommentRequest;
use App\Models\Article;
use App\Repositories\CommentRepository;

class CommentStore
{
    public function create(StoreCommentRequest $request, CommentRepository $commentRepository, Article $article)
    {
        $attributes = $request->validated();
        $attributes['owner_id'] = auth()->id();

        $commentRepository->createComment($article, $attributes);
    }
}
