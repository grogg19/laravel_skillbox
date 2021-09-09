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
use Illuminate\Support\Facades\Cache;
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

    public function index(Request $request)
    {
        $articles = Cache::tags(['articles', 'tags', 'users'])->remember('admin-list-articles-page-' . $request->get('page') ?? 1, 3600 * 24, function () {
            return $this->articleRepository->listAllArticles();
        });

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
     * @param $slug
     * @return View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($slug): View
    {
        $article = $this->articleRepository->getArticleBySlug($slug);

        $this->authorize('update', $article);

        return view('articles.admin.edit', compact('article'));
    }

    public function store(StoreArticleRequest $request, TagsSynchronizer $tagsSynchronizer, TagRequest $tagsRequest, ArticleStore $articleStore)
    {
        $articleStore->create($request, $tagsSynchronizer, $tagsRequest, $this->articleRepository);

        return redirect(route('admin.article.index'))
            ->with('status', 'Новая статья успешно записана!');
    }

    /**
     * Display the specified article.
     *
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function show($slug)
    {
        $article = Cache::tags(['articles', 'tags', 'users'])->remember('admin-article|' . $slug, 3600 * 24, function () use ($slug) {
            return $this->articleRepository->getArticleBySlug($slug);
        });

        if ($article === null) {
            return redirect(route('article.main'))
                ->with('status', 'Такой статьи не существует!');
        }

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
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($slug)
    {
        $article = $this->articleRepository->getArticleBySlug($slug);

        $this->authorize('delete', $article);

        $this->articleRepository->deleteArticle($article);

        return redirect(route('article.main'))
            ->with('status', 'Статья успешно удалена!');
    }
}
