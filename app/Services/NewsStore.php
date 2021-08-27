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
     * @var NewsRepositoryInterface
     */
    private $newsRepository;

    /**
     * @param NewsRepositoryInterface $newsRepository
     */
    public function __construct(NewsRepositoryInterface $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     * @param StoreNewsRequest $request
     * @return mixed
     */
    public function create(StoreNewsRequest $request)
    {
        $attributes = $request->validated();

        $attributes['is_published'] = $request->boolean('is_published');
        $attributes['author_id'] = auth()->id();

        return $this->newsRepository->createNews($attributes);
    }

    /**
     * @param StoreNewsRequest $request
     * @param News $newsItem
     */
    public function update(StoreNewsRequest $request, News $newsItem)
    {
        $attributes = $request->validated();
        $attributes['is_published'] = $request->boolean('is_published');

        $this->newsRepository->updateNews($newsItem, $attributes);
    }

}
