<?php


namespace App\Repositories;

/**
 * Interface ArticleInterface
 * @package App\Repositories
 */
interface ArticleRepositoryInterface
{
    public function listArticles();

    public function getArticleBySlug(string $slug);

    public function createArticle(array $data);

}
