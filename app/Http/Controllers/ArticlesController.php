<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\StoreArticleRequest;
use App\Repositories\ArticleRepositoryInterface;
use Illuminate\View\View;

/**
 * Class ArticlesController
 * @package App\Http\Controllers
 */
class ArticlesController extends Controller
{
    /**
     * @var ArticleRepositoryInterface
     */
    private $articleRequest;

    /**
     * ArticlesController constructor.
     * @param ArticleRepositoryInterface $articleRequest
     */
    public function __construct(ArticleRepositoryInterface $articleRequest)
    {
        $this->articleRequest = $articleRequest;
    }

    /**
     * Display a listing of the articles.
     *
     * @return View
     */
    public function index(): View
    {
        $articles = $this->articleRequest->listArticles();

        return view('index', compact('articles'));
    }

    /**
     * Show the form for creating a new article.
     * @return View
     */
    public function create(): View
    {
        return view('articles.create');
    }

    public function edit(): View
    {
        return view('articles.edit');
    }

    /**
     * Store a newly created article in storage.
     * @param StoreArticleRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreArticleRequest $request)
    {

        $resultValidation = $request->validated();

        $resultValidation['is_published'] = $request->boolean('is_published');

        $this->articleRequest->createArticle($resultValidation);

        return redirect(route('article.main'))
            ->with('status', 'Новая статья успешно записана!');
    }

    /**
     * Display the specified article.
     * @param string $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(string $slug)
    {
        $article = $this->articleRequest->getArticleBySlug($slug);

        return view('articles.show', compact('article'));
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
