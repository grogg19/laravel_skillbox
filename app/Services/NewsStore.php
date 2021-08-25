<?php

namespace App\Services;

use App\Http\Requests\Article\StoreArticleRequest;
use App\Http\Requests\News\StoreNewsRequest;
use App\Http\Requests\Tags\TagRequest;
use App\Models\HasTags;
use App\Models\News;
use App\Repositories\ArticleRepositoryInterface;
use App\Repositories\NewsRepositoryInterface;

class NewsStore
{
    /**
     * @param StoreNewsRequest $request
     * @param NewsRepositoryInterface $newsRepository
     * @return mixed
     */
    public function create(StoreNewsRequest $request, NewsRepositoryInterface $newsRepository)
    {
        $attributes = $request->validated();

        $attributes['is_published'] = $request->boolean('is_published');
        $attributes['author_id'] = auth()->id();

        $newsItem = $newsRepository->createNews($attributes);

        return $newsItem;
    }

    /**
     * @param StoreNewsRequest $request
     * @param NewsRepositoryInterface $newsRepository
     * @param News $newsItem
     */
    public function update(StoreNewsRequest $request, NewsRepositoryInterface $newsRepository, News $newsItem)
    {
        $attributes = $request->validated();
        $attributes['is_published'] = $request->boolean('is_published');

        $newsRepository->updateNews($newsItem, $attributes);
    }

}
