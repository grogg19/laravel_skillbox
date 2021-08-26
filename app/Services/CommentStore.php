<?php

namespace App\Services;

use App\Http\Requests\Comments\StoreCommentRequest;
use App\Models\HasComments;

class CommentStore
{
    public function create(StoreCommentRequest $request, HasComments $article)
    {
        $attributes = $request->validated();
        $attributes['owner_id'] = auth()->id();

        $article->comments()->create($attributes);
    }
}
