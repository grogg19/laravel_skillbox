<?php

namespace App\Repositories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ArticleRepository
 * @package App\Repositories
 */
class ArticleRepository implements ArticleRepositoryInterface
{
    /**
     * @return mixed
     */
    public function listArticles(): Collection
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
     * @param array $data
     */
    public function createArticle(array $data)
    {
        Article::create($data);
    }
}
