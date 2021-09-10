<?php

namespace App\Http\Controllers;

use App\Repositories\ArticleRepositoryInterface;
use App\Repositories\NewsRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class StatisticsController extends Controller
{
    public function index(
        ArticleRepositoryInterface $articleRepository,
        NewsRepositoryInterface $newsRepository,
        UserRepositoryInterface $userRepository
    )
    {
        $statistic = new Collection();

        // Количество статей и Новостей
        $statistic
            ->put(
                'totalArticles',
                Cache::tags(['articles', 'stats'])
                    ->remember(
                        'totalArticles',
                        3600 * 24,
                        function () use ($articleRepository) {
                            return $articleRepository->getAllArticlesCount();
                        }
                        )
            )
        ;

        $statistic
            ->put(
                'totalNews',
                Cache::tags(['news', 'stats'])
                    ->remember(
                        'totalNews',
                        3600 * 24,
                        function () use ($newsRepository) {
                            return $newsRepository->getAllNewsCount();
                        }
                        )
            )
        ;

        // самая длинная и самая короткая статья
        $statistic
            ->put(
                'longestArticle',
                Cache::tags(['articles', 'stats'])
                    ->remember(
                        'longestArticle',
                        3600 * 24,
                        function () use ($articleRepository) {
                            return $articleRepository->getLongestArticle();
                        }
                        )
            )
        ;

        $statistic
            ->put(
                'shortestArticle',
                Cache::tags(['articles', 'stats'])
                    ->remember(
                        'shortestArticle',
                        3600 * 24,
                        function () use ($articleRepository) {
                            return $articleRepository->getShortestArticle();
                        }
                        )
            )
        ;

        $statistic
            ->put(
                'authorManiac',
                Cache::tags(['users', 'articles', 'stats'])
                    ->remember(
                        'authorManiac',
                        3600 * 24,
                        function () use ($userRepository) {
                            return $userRepository->getAuthorManiac();
                        }
                        )
            )
        ;

        $statistic
            ->put(
                'averageQuantityArticles',
                Cache::tags(['articles', 'users', 'stats'])
                    ->remember(
                        'averageQuantityArticles',
                        3600 * 24,
                        function () use ($articleRepository) {
                            return $articleRepository->getAverageQuantityArticlesActiveUser();
                        }
                        )
            )
        ;

        $statistic
            ->put(
                'mostChangeableArticle',
                Cache::tags(['articles', 'stats'])
                    ->remember(
                        'mostChangeableArticle',
                        3600 * 24,
                        function () use ($articleRepository) {
                            return $articleRepository->getMostChangeableArticle();
                        }
                        )
            )
        ;

        $statistic
            ->put(
                'mostDiscussableArticle',
                Cache::tags(['articles', 'comments', 'stats'])
                    ->remember(
                        'mostDiscussableArticle',
                        3600 * 24,
                        function () use ($articleRepository) {
                            return $articleRepository->getMostDiscussableArticle();
                        }
                        )
            )
        ;

        return view('statistics', $statistic);
    }
}
