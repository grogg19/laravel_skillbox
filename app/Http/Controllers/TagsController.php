<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Support\Facades\Cache;

class TagsController extends Controller
{
    /**
     * @param Tag $tag
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Tag $tag)
    {
        $list = Cache::tags(['articles', 'news', 'tags'])->remember('list-articles-news-' . $tag->name, 3600 * 24, function () use ($tag) {
            return Tag::where('name', $tag->name)
                ->with(['articles', 'news'])
                ->first();
        });

        return view('tags.articles_news', ['articles' => $list->articles, 'news'=> $list->news]);
    }
}
