<?php

namespace App\Repositories;

use App\Models\Article;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class ArticleRepository
 * @package App\Repositories
 */
class ArticleRepository implements ArticleRepositoryInterface
{

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function listAllArticles(int $perPage = 20): LengthAwarePaginator
    {
        return Article::latest()
            ->with('tags')
            ->paginate($perPage);
    }

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function listArticles(int $perPage = 10): LengthAwarePaginator
    {
        return Article::latest()
            ->with('tags')
            ->where('is_published', true)
            ->paginate($perPage);
    }

    /**
     * @param string $slug
     * @return mixed
     */
    public function getArticleBySlug(string $slug)
    {
        return Article::where('slug', $slug)
            ->with('comments')
            ->first();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getArticleById(int $id)
    {
        return Article::with('comments')
            ->find($id);
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

    public function getAllArticlesCount()
    {
        return Article::count();
    }

    public function getLongestArticle()
    {
        return Article::selectRaw('title, slug, LENGTH(body) as lengthBody')
            ->orderBy('lengthBody', 'desc')
            ->first();
    }

    public function getShortestArticle()
    {
        return Article::selectRaw('title, slug, LENGTH(body) as lengthBody')
            ->orderBy('lengthBody', 'asc')
            ->first();
    }

    public function getAuthorManiac()
    {
        return Article::leftJoin('users', 'users.id', '=', 'articles.owner_id')
            ->select('users.name', DB::raw('count(*) as articles_count'))
            ->groupBy('users.name')
            ->orderBy('articles_count', 'desc')
            ->first();
    }

    public function getAverageQuantityArticlesActiveUser(): int
    {
        return Article::leftJoin('users', 'users.id', '=', 'articles.owner_id')
            ->select('users.name', DB::raw('count(*) as total_articles'))
            ->groupBy('users.name')
            ->havingRaw('total_articles > 1')
            ->avg('total_articles');
    }

    public function getMostChangeableArticle()
    {
        return Article::leftJoin('article_histories', 'article_histories.article_id', '=', 'articles.id')
            ->select('articles.title', 'articles.slug', DB::raw('count(*) as total_changes'))
            ->groupBy('articles.slug')
            ->orderBy('total_changes', 'desc')
            ->first();
    }

    public function getMostDiscussableArticle()
    {
        return Article::leftJoin('comments', 'comments.commentable_id', '=', 'articles.id')
            ->select('articles.title', 'articles.slug', DB::raw('count(*) as total_comments'))
            ->where('comments.commentable_type', '=', 'article')
            ->groupBy('articles.slug')
            ->orderBy('total_comments', 'desc')
            ->first();
    }


}
