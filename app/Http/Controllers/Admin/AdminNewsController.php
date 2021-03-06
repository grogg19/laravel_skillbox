<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\StoreNewsRequest;
use App\Http\Requests\Tags\TagRequest;
use App\Repositories\NewsRepositoryInterface;
use App\Services\TagsSynchronizer;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;

class AdminNewsController extends Controller
{

    private $newsRepository;

    public function __construct(NewsRepositoryInterface $newsRepository)
    {
        $this->middleware(['admin']);
        $this->newsRepository = $newsRepository;
    }

    /**
     * * Display a listing of the resource.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $currentPage = $request->get('page') ?: 1;

        $news = Cache::tags(['news', 'tags'])->remember('admin-list-news-page-' . $currentPage, 3600 * 24, function () use ($currentPage) {
            return $this->newsRepository->listAllNews($currentPage);
        });

        return view('news.admin.list', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('news.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreNewsRequest $request
     * @param TagRequest $tagRequest
     * @param TagsSynchronizer $tagsSynchronizer
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreNewsRequest $request, TagRequest $tagRequest, TagsSynchronizer $tagsSynchronizer)
    {
        $attributes = $request->validated();

        $attributes['is_published'] = $request->boolean('is_published');
        $attributes['author_id'] = auth()->id();

        $news = $this->newsRepository->createNews($attributes);

        $tags = $tagRequest->getTags($request);
        $tagsSynchronizer->sync($tags, $news);

        return redirect(route('admin.news.index'))
            ->with('status', '?????????? ???????????? ?????????????? ????????????????!');
    }

    /**
     * Display the specified resource.
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function show($slug)
    {
        $news = Cache::tags(['news', 'tags'])->remember('admin-news|' . $slug, 3600 * 24, function () use ($slug) {
            return $this->newsRepository->getNewsBySlug($slug);
        });

        if ($news === null) {
            return redirect(route('admin.news.main'))
                ->with('status', '?????????? ?????????????? ???? ????????????????????!');
        }

        return view('news.admin.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($slug)
    {
        $news = $this->newsRepository->getNewsBySlug($slug);

        $this->authorize('update', $news);

        return view('news.admin.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreNewsRequest $request
     * @param string $slug
     * @param TagRequest $tagRequest
     * @param TagsSynchronizer $tagsSynchronizer
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(StoreNewsRequest $request, string $slug, TagRequest $tagRequest, TagsSynchronizer $tagsSynchronizer)
    {
        $news = $this->newsRepository->getNewsBySlug($slug);

        $this->authorize('update', $news);

        $attributes = $request->validated();
        $attributes['is_published'] = $request->boolean('is_published');

        $this->newsRepository->updateNews($news, $attributes);

        $tags = $tagRequest->getTags($request);
        $tagsSynchronizer->sync($tags, $news);

        return redirect(route('admin.news.index'))
            ->with('status', '?????????????? ?????????????? ??????????????????!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(string $slug)
    {
        $news = $this->newsRepository->getNewsBySlug($slug);

        $this->authorize('delete', $news);

        $this->newsRepository->deleteNews($news);

        return redirect(route('admin.news.index'))
            ->with('status', '?????????????? ?????????????? ??????????????!');
    }
}
