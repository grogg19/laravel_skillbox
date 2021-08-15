<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagsController extends Controller
{
    public function index(Tag $tag)
    {
        $articles = $tag->articles()
            ->where('is_published', 1)
            ->with('tags')
            ->get();

        return view('index', compact('articles'));
    }
}
