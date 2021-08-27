<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\StoreNewsRequest;
use App\Repositories\NewsRepositoryInterface;

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreNewsRequest $request)
    {
        $attributes = $request->validated();

        $attributes['is_published'] = $request->boolean('is_published');
        $attributes['author_id'] = auth()->id();

        $this->newsRepository->createNews($attributes);

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
        $news = $this->newsRepository->getNewsBySlug($slug);

        if ($news === null) {
            return redirect(route('admin.news.main'))
                ->with('status', 'Такой новости не существует!');
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(StoreNewsRequest $request, string $slug)
    {
        $news = $this->newsRepository->getNewsBySlug($slug);

        $this->authorize('update', $news);

        $attributes = $request->validated();
        $attributes['is_published'] = $request->boolean('is_published');

        $this->newsRepository->updateNews($news, $attributes);

        return redirect(route('admin.news.index'))
            ->with('status', 'Новость успешно обновлена!');

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
            ->with('status', 'Новость успешно удалена!');
    }
}
