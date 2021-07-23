<?php

namespace App\Repositories;

use App\Models\Article;

class ArticleRepository
{
    public static function listArticles()
    {
        return Article::latest()->get();
    }

    public function getArticle($id)
    {
        return Article::where('id', $id)->get();
    }
}
