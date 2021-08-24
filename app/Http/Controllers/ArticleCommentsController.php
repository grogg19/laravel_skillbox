<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comments\StoreCommentRequest;
use App\Models\Article;
use App\Repositories\CommentRepositoryInterface;
use App\Services\CommentStore;

class ArticleCommentsController extends Controller
{
    /**
     * @var CommentRepositoryInterface
     */
    private $commentRepository;

    /**
     * @param CommentRepositoryInterface $commentRepository
     */
    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->middleware(['auth']);
        $this->commentRepository = $commentRepository;
    }

    public function store(StoreCommentRequest $request, CommentStore $commentStore, Article $article)
    {
        $commentStore->create($request, $this->commentRepository, $article);

        return back()
            ->with('status', 'Ваш комментарий успешно опубликован.');
    }
}
