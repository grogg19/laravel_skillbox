<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\StoreArticleRequest;
use App\Http\Requests\Tags\TagRequest;
use App\Models\Article;
use App\Repositories\ArticleRepositoryInterface;
use App\Services\ArticleStore;
use App\Services\TagsSynchronizer;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminArticlesController extends Controller
{
    /**
     * @var ArticleRepositoryInterface
     */
    private $articleRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->middleware(['admin']);
        $this->articleRepository = $articleRepository;
    }

    public function index()
    {
        $articles = $this->articleRepository->listAllArticles();

        return view('articles.admin.list', compact('articles'));
    }

    /**
     * Show the form for creating a new article.
     * @return View
     */
    public function create(): View
    {
        return view('articles.admin.create');
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

        return view('articles.admin.edit', compact('article'));
    }

    public function store(StoreArticleRequest $request, TagsSynchronizer $tagsSynchronizer, TagRequest $tagsRequest, ArticleStore $articleStore)
    {
        $article = $articleStore->create($request, $tagsSynchronizer, $tagsRequest, $this->articleRepository);

        push_all($article->title, $article->excerpt, route('article.show', $article));

        return redirect(route('admin.article.index'))
            ->with('status', 'Новая статья успешно записана!');
    }

    /**
     * Display the specified article.
     * @param $articleKey
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($articleKey)
    {
        $article = is_numeric($articleKey) ? $this->articleRepository->getArticleById($articleKey)
            : $this->articleRepository->getArticleBySlug($articleKey);

        return view('articles.admin.show', compact('article'));
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

        return redirect(route('admin.article.index'))
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
