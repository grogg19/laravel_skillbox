<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagsController extends Controller
{
    /**
     * @param Tag $tag
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Tag $tag)
    {
        $articles = $tag->articles()
            ->latest()
            ->where('is_published', 1)
            ->with('tags')
            ->get();

        $news = $tag->news()
            ->latest()
            ->where('is_published', 1)
            ->with('tags')
            ->get();

        return view('tags.articles_news', compact('articles', 'news'));
    }
}
