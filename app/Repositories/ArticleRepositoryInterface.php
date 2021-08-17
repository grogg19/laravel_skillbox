<?php


namespace App\Repositories;

use App\Models\Article;
use Illuminate\Support\Facades\Date;

/**
 * Interface ArticleInterface
 * @package App\Repositories
 */
interface ArticleRepositoryInterface
{
    public function listArticles();

    public function listAllArticles();

    public function getArticleBySlug(string $slug);

    public function getArticleById(int $id);

    public function getPublishedArticlesByDateInterval(string $from, string $to);

    public function createArticle(array $attributes);

    public function updateArticle(Article $article, array $attributes);

    public function deleteArticle(Article $article);

}
