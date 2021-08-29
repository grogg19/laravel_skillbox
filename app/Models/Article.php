<?php

namespace App\Models;

use App\Events\ArticleCreated;
use App\Events\ArticleDeleted;
use App\Events\ArticleUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

/**
 * Class Article
 * @package App\Models
 */
class Article extends Model implements HasTags, HasComments
{
    use HasFactory;

    protected $guarded = [];

    protected $dispatchesEvents = [
        'created' => ArticleCreated::class,
        'updated' => ArticleUpdated::class,
        'deleted' => ArticleDeleted::class
    ];

    protected $casts = [
        'is_published' => 'boolean'
    ];

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

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function history()
    {
        return $this->belongsToMany(ArticleHistory::class, 'article_histories', 'article_id', 'user_id')
            ->using(ArticleHistory::class)
            ->withPivot(['before', 'after'])
            ->withTimestamps();
    }

    public function addComment($attributes)
    {
        $this->comments()->create($attributes);
    }

    protected static function boot()
    {
        parent::boot();

        static::updating(function (Article $article) {

            $after = $article->getDirty();

            $article->history()->attach(auth()->id(), [
                'before' => Arr::only($article->fresh()->toArray(), array_keys($after)),
                'after' => $after
            ]);
        });
    }

}
