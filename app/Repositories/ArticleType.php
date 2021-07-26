<?php


namespace App\Repositories;

/**
 * Interface ArticleInterface
 * @package App\Repositories
 */
interface ArticleType
{
    public function listArticles();

    public function getArticleBySlug(string $slug);

    public function createArticle(array $data);

}
