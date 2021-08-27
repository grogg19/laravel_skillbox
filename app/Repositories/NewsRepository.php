<?php

namespace App\Repositories;

use App\Models\News;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class NewsRepository implements NewsRepositoryInterface
{

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function listPublishedNews(int $perPage = 10): LengthAwarePaginator
    {
        return News::latest()
            ->where('is_published', true)
            ->paginate($perPage);
    }

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function listAllNews(int $perPage = 20): LengthAwarePaginator
    {
        return News::latest()
            ->paginate($perPage);
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
}
