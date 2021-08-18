<?php

namespace App\Repositories;

use App\Models\Article;
use Carbon\Carbon;
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
    public function listAllArticles()
    {
        return Article::latest()->get();
    }

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
     * @param int $id
     * @return mixed
     */
    public function getArticleById(int $id)
    {
        return Article::find($id);
    }

    /**
     * @param Carbon $from
     * @param Carbon $to
     * @return mixed
     */
    public function getPublishedArticlesByDateInterval(Carbon $from, Carbon $to)
    {
        return Article::latest()
            ->where('is_published', 1)
            ->whereBetween('created_at', [$from, $to])
            ->get();
    }

    /**
     * @param array $attributes
     * @return Article
     */
    public function createArticle(array $attributes): Article
    {
        return Article::create($attributes);
    }

    /**
     * @param Article $article
     * @param array $attributes
     */
    public function updateArticle(Article $article, array $attributes)
    {
        $article->update($attributes);
    }

    public function deleteArticle(Article $article)
    {
        $article->delete();
    }

}
