<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\StoreNewsRequest;
use App\Models\News;
use App\Repositories\NewsRepositoryInterface;
use App\Services\NewsStore;
use Illuminate\Http\Request;

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
    public function index()
    {
        $news = $this->newsRepository->listAllNews();

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
     * @param NewsStore $newsStore
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreNewsRequest $request, NewsStore $newsStore)
    {
        $newsStore->create($request);

        return redirect(route('admin.news.index'))
            ->with('status', 'Новая статья успешно записана!');
    }

    /**
     * Display the specified resource.
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function show($slug)
    {
        $newsItem = $this->newsRepository->getNewsBySlug($slug);

        if ($newsItem === null) {
            return redirect(route('admin.news.main'))
                ->with('status', 'Такой новости не существует!');
        }

        return view('news.admin.show', compact('newsItem'));
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
        $newsItem = $this->newsRepository->getNewsBySlug($slug);

        $this->authorize('update', $newsItem);

        return view('news.admin.edit', compact('newsItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreNewsRequest $request
     * @param News $news
     * @param NewsStore $newsStore
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(StoreNewsRequest $request, News $news, NewsStore $newsStore)
    {
        $this->authorize('update', $news);

        $newsStore->update($request, $news);

        return redirect(route('admin.news.index'))
            ->with('status', 'Новость успешно обновлена!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param News $news
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(News $news)
    {
        $this->authorize('delete', $news);

        $this->newsRepository->deleteNews($news);

        return redirect(route('admin.news.index'))
            ->with('status', 'Новость успешно удалена!');
    }
}
