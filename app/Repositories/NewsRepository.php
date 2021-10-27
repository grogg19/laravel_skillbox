<?php

namespace App\Repositories;

use App\Models\News;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class NewsRepository implements NewsRepositoryInterface
{

    /**
     * @param int $currentPage
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function listPublishedNews($currentPage = 1, int $perPage = 10): LengthAwarePaginator
    {
        return News::latest()
            ->where('is_published', true)
            ->with('tags')
            ->paginate($perPage, '*', 'page', $currentPage);
    }

    /**
     * @param int $currentPage
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function listAllNews($currentPage = 1, int $perPage = 20): LengthAwarePaginator
    {
        return News::latest()
            ->with('tags')
            ->paginate($perPage, '*', 'page', $currentPage);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getNewsById(int $id)
    {
        return News::find($id);
    }

    /**
     * @param string $slug
     * @return mixed
     */
    public function getNewsBySlug(string $slug)
    {
        return News::where('slug', $slug)
            ->with('tags')
            ->with('comments')
            ->first();
    }

    /**
     * @param array $attributes
     * @return News
     */
    public function createNews(array $attributes): News
    {
        return News::create($attributes);
    }

    /**
     * @param News $news
     * @param array $attributes
     */
    public function updateNews(News $news, array $attributes)
    {
        $news->update($attributes);
    }

    /**
     * @param News $news
     */
    public function deleteNews(News $news)
    {
        $news->delete();
    }

    public function getAllNewsCount(): int
    {
        return News::count();
    }
}
