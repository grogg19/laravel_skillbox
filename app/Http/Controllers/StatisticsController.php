<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Repositories\ArticleRepositoryInterface;
use App\Repositories\NewsRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index(ArticleRepositoryInterface $articleRepository, NewsRepositoryInterface $newsRepository)
    {
        $statistic = new Collection();

        // Количество статей и Новостей
        $statistic->put('totalArticles', $articleRepository->getAllArticlesCount());
        $statistic->put('totalNews', $newsRepository->getAllNewsCount());

        // самая длинная и самая короткая статья
        $statistic->put('longestArticle', $articleRepository->getLongestArticle());
        $statistic->put('shortestArticle', $articleRepository->getShortestArticle());

        $statistic->put('authorManiac', $articleRepository->getAuthorManiac());
        $statistic->put('averageQuantityArticles', $articleRepository->getAverageQuantityArticlesActiveUser());

        $statistic->put('mostChangeableArticle', $articleRepository->getMostChangeableArticle());
        $statistic->put('mostDiscussableArticle', $articleRepository->getMostDiscussableArticle());

        return view('statistics', $statistic);
    }
}
