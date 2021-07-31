<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\StoreArticleRequest;
use App\Models\Article;
use App\Repositories\ArticleRepositoryInterface;
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
     * @param $id
     * @return View
     */
    public function edit($id): View
    {
        $article = $this->articleRepository->getArticleById($id);
        return view('articles.edit', compact('article'));
    }

    /**
     * Store a newly created article in storage.
     * @param StoreArticleRequest $request
     * @param TagsSynchronizer $tagsSynchronizer
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreArticleRequest $request, TagsSynchronizer $tagsSynchronizer)
    {
        $attributes = $request->validated();
        $attributes['is_published'] = $request->boolean('is_published');

        $article = $this->articleRepository->createArticle($attributes);

        $tags = collect(explode(',', $request->post('tags')));

        $tagsSynchronizer->sync($tags, $article);

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
        $article = $this->articleRepository->getArticleBySlug($slug);

        return view('articles.show', compact('article'));
    }

    /**
     * @param StoreArticleRequest $request
     * @param Article $article
     * @param TagsSynchronizer $tagsSynchronizer
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(StoreArticleRequest $request, Article $article, TagsSynchronizer $tagsSynchronizer)
    {
        $attributes = $request->validated();
        $attributes['is_published'] = $request->boolean('is_published');

        $this->articleRepository->updateArticle($article, $attributes);

        $tags = collect(explode(',', $request->post('tags')));

        $tagsSynchronizer->sync($tags, $article);

        return redirect(route('article.main'))
            ->with('status', 'Статья успешно обновлена!');
    }

    /**
     * @param Article $article
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Article $article)
    {
        $this->articleRepository->deleteArticle($article);

        return redirect(route('article.main'))
            ->with('status', 'Статья успешно удалена!');
    }
}
