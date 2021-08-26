<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comments\StoreCommentRequest;
use App\Models\Article;
use App\Services\CommentStore;

class ArticleCommentsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(StoreCommentRequest $request, CommentStore $commentStore, Article $article)
    {
        $commentStore->create($request, $article);

        return back()
            ->with('status', 'Ваш комментарий успешно опубликован.');
    }
}
