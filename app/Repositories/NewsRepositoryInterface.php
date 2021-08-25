<?php

namespace App\Repositories;

use App\Models\News;

interface NewsRepositoryInterface
{
    public function listPublishedNews();

    public function listAllNews();

    public function getNewsBySlug(string $slug);

    public function getNewsById(int $id);

    public function createNews(array $attributes);

    public function updateUpdate(News $news, array $attributes);

    public function deleteNews(News $news);
}
