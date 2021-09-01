<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comments\StoreCommentRequest;
use App\Models\Article;
use App\Models\News;
use App\Services\CommentStore;

class CommentsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * @param StoreCommentRequest $request
     * @param CommentStore $commentStore
     * @param Article $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeCommentArticle(StoreCommentRequest $request, CommentStore $commentStore, Article $article)
    {
        $commentStore->create($request, $article);

        return back()
            ->with('status', 'Ваш комментарий успешно опубликован.');
    }

    public function storeCommentNews(StoreCommentRequest $request, CommentStore $commentStore, News $news)
    {
        $commentStore->create($request, $news);

        return back()
            ->with('status', 'Ваш комментарий успешно опубликован.');
    }
}
