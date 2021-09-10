<?php

namespace App\Http\Controllers;

use App\Repositories\NewsRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
    public function index(Request $request)
    {
        $news = Cache::tags(['news', 'tags'])->remember('list-news-page-' . ($request->get('page') ?: 1), 3600 * 24, function () {
            return $this->newsRepository->listPublishedNews();
        });

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
        $news = Cache::tags(['news', 'tags'])->remember('news|' . $slug, 3600 * 24, function () use ($slug) {
            return $this->newsRepository->getNewsBySlug($slug);
        });

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
