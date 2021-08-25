<?php

namespace App\Repositories;

use App\Models\News;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class NewsRepository implements NewsRepositoryInterface
{

    /**
     * @return LengthAwarePaginator
     */
    public function listPublishedNews(): LengthAwarePaginator
    {
        return News::latest()
            ->where('is_published', true)
            ->paginate(10);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function listAllNews(): LengthAwarePaginator
    {
        return News::latest()
            ->paginate(20);
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
