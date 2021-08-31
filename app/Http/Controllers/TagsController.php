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
        $list = Tag::where('id', $tag->id)
            ->with('articles')
            ->with('news')
            ->first();

        return view('tags.articles_news', ['articles' => $list->articles, 'news'=> $list->news]);
    }
}
