<?php

namespace App\Services;

use App\Http\Requests\Article\StoreArticleRequest;
use App\Http\Requests\Tags\TagRequest;
use App\Models\HasTags;
use App\Repositories\ArticleRepositoryInterface;

class ArticleStore
{
    /**
     * @param StoreArticleRequest $request
     * @param TagsSynchronizer $tagsSynchronizer
     * @param TagRequest $tagRequest
     * @param ArticleRepositoryInterface $articleRepository
     */
    public function create(StoreArticleRequest $request, TagsSynchronizer $tagsSynchronizer, TagRequest $tagRequest, ArticleRepositoryInterface $articleRepository)
    {
        $attributes = $request->validated();

        $attributes['is_published'] = $request->boolean('is_published');
        $attributes['owner_id'] = auth()->id();

        $article = $articleRepository->createArticle($attributes);

        $tags = $tagRequest->getTags($request);

        $tagsSynchronizer->sync($tags, $article);

        return $article;
    }

    /**
     * @param StoreArticleRequest $request
     * @param TagsSynchronizer $tagsSynchronizer
     * @param TagRequest $tagsRequest
     * @param ArticleRepositoryInterface $articleRepository
     * @param HasTags $article
     */
    public function update(StoreArticleRequest $request, TagsSynchronizer $tagsSynchronizer, TagRequest $tagsRequest, ArticleRepositoryInterface $articleRepository, HasTags $article)
    {
        $attributes = $request->validated();

        $attributes['is_published'] = $request->boolean('is_published');

        $articleRepository->updateArticle($article, $attributes);

        $tags = $tagsRequest->getTags($request);

        $tagsSynchronizer->sync($tags, $article);
    }

}
