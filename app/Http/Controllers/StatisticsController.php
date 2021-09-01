<?php

namespace App\Http\Controllers;

use App\Repositories\ArticleRepositoryInterface;
use App\Repositories\NewsRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class StatisticsController extends Controller
{
    public function index(ArticleRepositoryInterface $articleRepository, NewsRepositoryInterface $newsRepository, UserRepositoryInterface $userRepository)
    {
        $statistic = new Collection();

        // Количество статей и Новостей
        $statistic->put('totalArticles', $articleRepository->getAllArticlesCount());
        $statistic->put('totalNews', $newsRepository->getAllNewsCount());

        // самая длинная и самая короткая статья
        $statistic->put('longestArticle', $articleRepository->getLongestArticle());
        $statistic->put('shortestArticle', $articleRepository->getShortestArticle());

        $statistic->put('authorManiac', $userRepository->getAuthorManiac());
        $statistic->put('averageQuantityArticles', $articleRepository->getAverageQuantityArticlesActiveUser());

        $statistic->put('mostChangeableArticle', $articleRepository->getMostChangeableArticle());
        $statistic->put('mostDiscussableArticle', $articleRepository->getMostDiscussableArticle());

        return view('statistics', $statistic);
    }
}
