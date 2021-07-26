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
    public function listArticles()
    {
        return Article::latest()
            ->where('is_published', 1)
            ->get();
    }

    /**
     * @param string $slug
     * @return mixed
     */
    public function getArticleBySlug(string $slug)
    {
        return Article::where('slug', $slug)->first();
    }

    /**
     * @param $data
     */
    public function createArticle($data)
    {
        Article::create($data);
    }
}
