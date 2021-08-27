<?php

namespace App\Http\Controllers;

use App\Repositories\NewsRepositoryInterface;

class NewsController extends Controller
{

    private $newsRepository;

    public function __construct(NewsRepositoryInterface $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $news = $this->newsRepository->listPublishedNews();

        return view('news.list', compact('news'));
    }


    /**
     * Display the specified resource.
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($slug)
    {
        $news = $this->newsRepository->getNewsBySlug($slug);

        if ($news === null) {
            return redirect(route('news.main'))
                ->with('status', 'Такой новости не существует!');
        }

        if (!$news->is_published) {
            $this->authorize('show', $news);
        }

        return view('news.show', compact('news'));
    }
}
