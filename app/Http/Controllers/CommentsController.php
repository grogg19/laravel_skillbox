<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comments\StoreCommentRequest;
use App\Services\CommentStore;
use Illuminate\Database\Eloquent\Relations\Relation;

class CommentsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * @param StoreCommentRequest $request
     * @param CommentStore $commentStore
     * @param $type
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCommentRequest $request, CommentStore $commentStore, $type, $slug)
    {

        $model = Relation::getMorphedModel($type);
        $instance = $model::where('slug', $slug)->first();

        $commentStore->create($request, $instance);

        return back()
            ->with('status', 'Ваш комментарий успешно опубликован.');
    }
}
