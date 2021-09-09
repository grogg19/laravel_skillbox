<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\StoreArticleRequest;
use App\Http\Requests\Tags\TagRequest;
use App\Models\Article;
use App\Repositories\ArticleRepositoryInterface;
use App\Services\ArticleStore;
use App\Services\TagsSynchronizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $articles = Cache::tags(['articles', 'tags'])->remember('list-articles-page-' . ($request->get('page') ?: 1), 3600 * 24, function () {
            return $this->articleRepository->listArticles();
        });

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
     * @param $slug
     * @return View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($slug): View
    {
        $article = $this->articleRepository->getArticleBySlug($slug);

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
        $articleStore->create($request, $tagsSynchronizer, $tagsRequest, $this->articleRepository);

        return redirect(route('article.main'))
            ->with('status', 'Новая статья успешно записана!');
    }

    /**
     * Display the specified article.
     *
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($slug)
    {
        $article = Cache::tags(['articles', 'comments', 'tags'])->remember('article|' . $slug, 3600 * 24, function () use ($slug) {
            return $this->articleRepository->getArticleBySlug($slug);
        });


        if ($article === null) {
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
