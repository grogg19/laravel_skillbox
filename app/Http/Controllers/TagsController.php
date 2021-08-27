<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagsController extends Controller
{
    /**
     * @param Tag $tag
     * @param int $perPage
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Tag $tag, int $perPage = 10)
    {
        $articles = $tag->articles()
            ->latest()
            ->where('is_published', 1)
            ->with('tags')
            ->paginate($perPage);

        return view('index', compact('articles'));
    }
}
