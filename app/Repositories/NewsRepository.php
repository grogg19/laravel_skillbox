<?php

namespace App\Repositories;

use App\Models\News;
use Illuminate\Database\Eloquent\Collection;

class NewsRepository implements NewsRepositoryInterface
{

    /**
     * @return Collection
     */
    public function listPublishedNews(): Collection
    {
        return News::latest()
            ->where('is_published', true)
            ->get();
    }

    /**
     * @return Collection
     */
    public function listAllNews(): Collection
    {
        return News::latest()
            ->get();
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
