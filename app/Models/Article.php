<?php

namespace App\Models;

use App\Events\ArticleCreated;
use App\Events\ArticleDeleted;
use App\Events\ArticleUpdated;
use App\Helpers\CacheCleanable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

/**
 * Class Article
 * @package App\Models
 */
class Article extends Model implements HasTags, HasComments
{
    use HasFactory;
    use CacheCleanable;

    protected $guarded = [];

    protected static $tags = ['articles'];

    protected $dispatchesEvents = [
        'created' => ArticleCreated::class,
        'updated' => ArticleUpdated::class,
        'deleted' => ArticleDeleted::class
    ];

    protected $casts = [
        'is_published' => 'boolean'
    ];

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function history()
    {
        return $this->belongsToMany(User::class, 'article_histories', 'article_id', 'user_id')
            ->using(ArticleHistory::class)
            ->withPivot(['before', 'after'])
            ->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function historyByPivot()
    {
        return $this->belongsToMany(User::class, 'article_histories', 'article_id', 'user_id')
            ->using(ArticleHistory::class)
            ->withPivot(['before', 'after'])
            ->withTimestamps()
            ->orderByPivot('updated_at');
    }

    /**
     * @param $attributes
     * @return void
     */
    public function addComment($attributes)
    {
        $this->comments()->create($attributes);
    }

    /**
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::updating(function (Article $article) {

            $after = $article->getDirty(); // получаем атрибуты, которые изменились с последней синхронизации

            $article->history()->attach(auth()->id(), [
                'before' => Arr::only($article->fresh()->toArray(), array_keys($after)),
                'after' => $after
            ]);
        });
    }

}
