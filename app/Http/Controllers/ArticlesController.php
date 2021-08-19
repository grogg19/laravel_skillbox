<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\StoreArticleRequest;
use App\Http\Requests\Tags\TagRequest;
use App\Models\Article;
use App\Models\Tag;
use App\Repositories\ArticleRepositoryInterface;
use App\Services\ArticleStore;
use App\Services\TagsSynchronizer;
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
    private $articleRepository;

    /**
     * @param ArticleRepositoryInterface $articleRepository
     */
    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->middleware(['auth'])->except(['index', 'show']);
        $this->articleRepository = $articleRepository;
    }

    /**
     * Display a listing of the articles.
     *
     * @return View
     */
    public function index(): View
    {
        $articles = $this->articleRepository->listArticles();

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
     * @param $articleKey
     * @return View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($articleKey): View
    {
        $article = is_numeric($articleKey) ? $this->articleRepository->getArticleById($articleKey)
            : $this->articleRepository->getArticleBySlug($articleKey);

        $this->authorize('update', $article);

        return view('articles.edit', compact('article'));
    }

    /**
     * Store a newly created article in storage.
     * @param StoreArticleRequest $request
     * @param TagsSynchronizer $tagsSynchronizer
     * @param TagRequest $tagsRequest
     * @param ArticleStore $articleStore
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreArticleRequest $request, TagsSynchronizer $tagsSynchronizer, TagRequest $tagsRequest, ArticleStore $articleStore)
    {
        $article = $articleStore->create($request, $tagsSynchronizer, $tagsRequest, $this->articleRepository);

        push_all($article->title, $article->excerpt, route('article.show', $article));

        return redirect(route('article.main'))
            ->with('status', 'Новая статья успешно записана!');
    }

    /**
     * Display the specified article.
     * @param $articleKey
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($articleKey)
    {
        $article = is_numeric($articleKey) ? $this->articleRepository->getArticleById($articleKey)
            : $this->articleRepository->getArticleBySlug($articleKey);

        if($article === null) {
            return redirect(route('article.main'))
                ->with('status', 'Такой статьи не существует!');
        }

        if (!$article->is_published) {
            $this->authorize('show', $article);
        }

        return view('articles.show', compact('article'));
    }

    /**
     * @param StoreArticleRequest $request
     * @param Article $article
     * @param TagsSynchronizer $tagsSynchronizer
     * @param TagRequest $tagsRequest
     * @param ArticleStore $articleStore
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(StoreArticleRequest $request, Article $article, TagsSynchronizer $tagsSynchronizer, TagRequest $tagsRequest, ArticleStore $articleStore)
    {
        $this->authorize('update', $article);

        $articleStore->update($request, $tagsSynchronizer, $tagsRequest, $this->articleRepository, $article);

        return redirect(route('article.main'))
            ->with('status', 'Статья успешно обновлена!');
    }

    /**
     * @param Article $article
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);

        $this->articleRepository->deleteArticle($article);

        return redirect(route('article.main'))
            ->with('status', 'Статья успешно удалена!');
    }
}
