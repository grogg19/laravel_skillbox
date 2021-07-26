<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\StoreArticle;
use App\Repositories\ArticleType;
use Illuminate\View\View;

/**
 * Class ArticlesController
 * @package App\Http\Controllers
 */
class ArticlesController extends Controller
{
    /**
     * @var ArticleType
     */
    private $articleStorage;

    /**
     * ArticlesController constructor.
     * @param ArticleType $articleStorage
     */
    public function __construct(ArticleType $articleStorage)
    {
        $this->articleStorage = $articleStorage;
    }

    /**
     * Display a listing of the articles.
     *
     * @return View
     */
    public function index(): View
    {
        $articles = $this->articleStorage->listArticles();

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

    /**
     * Store a newly created article in storage.
     * @param StoreArticle $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreArticle $request)
    {

        $resultValidation = $request->validated();

        $resultValidation['is_published'] = $request->boolean('is_published');

        $this->articleStorage->createArticle($resultValidation);

        return redirect(route('page.main'));
    }

    /**
     * Display the specified article.
     * @param string $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(string $slug)
    {
        $article = $this->articleStorage->getArticleBySlug($slug);

        return view('articles.show', compact('article'));
    }
}
