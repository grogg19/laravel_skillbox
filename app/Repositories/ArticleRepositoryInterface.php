<?php


namespace App\Repositories;

use App\Models\Article;

/**
 * Interface ArticleInterface
 * @package App\Repositories
 */
interface ArticleRepositoryInterface
{
    public function listArticles();

    public function getArticleBySlug(string $slug);

    public function getArticleById(int $id);

    public function createArticle(array $attributes);

    public function updateArticle(Article $article, array $attributes);

}
