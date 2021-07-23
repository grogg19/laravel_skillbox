<?php

namespace App\Repositories;

use App\Models\Article;

/**
 * Class ArticleRepository
 * @package App\Repositories
 */
class ArticleRepository
{
    /**
     * @return mixed
     */
    public static function listArticles()
    {
        return Article::latest()->get();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getArticleById(int $id)
    {
        return Article::where('id', $id)->get();
    }

    /**
     * @param string $slug
     * @return mixed
     */
    public function getArticleBySlug(string $slug)
    {
        return Article::where('slug', $slug);
    }
}
