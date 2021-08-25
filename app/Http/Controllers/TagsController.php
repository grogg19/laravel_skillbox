<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagsController extends Controller
{
    public function index(Tag $tag)
    {
        $articles = $tag->articles()
            ->latest()
            ->where('is_published', 1)
            ->with('tags')
            ->paginate(10);

        return view('index', compact('articles'));
    }
}
