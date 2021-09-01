<?php

namespace App\Services;

use App\Http\Requests\Comments\StoreCommentRequest;
use App\Models\HasComments;

class CommentStore
{
    public function create(StoreCommentRequest $request, HasComments $model)
    {
        $attributes = $request->validated();
        $attributes['owner_id'] = auth()->id();

        $model->comments()->create($attributes);
    }
}
