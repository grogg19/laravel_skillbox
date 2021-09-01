<?php


namespace App\Repositories;

use App\Models\Article;
use Carbon\Carbon;

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

    public function getPublishedArticlesByDateInterval(Carbon $from, Carbon $to);

    public function createArticle(array $attributes);

    public function updateArticle(Article $article, array $attributes);

    public function deleteArticle(Article $article);

    public function getLongestArticle();

    public function getShortestArticle();

    public function getAllArticlesCount();

    public function getAverageQuantityArticlesActiveUser();

    public function getMostChangeableArticle();

    public function getMostDiscussableArticle();

}
