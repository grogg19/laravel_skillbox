<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class News extends Model implements HasTags, HasComments
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'is_published' => 'boolean'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function () {
            Cache::tags(['news'])->flush();
        });

        static::updated(function () {
            Cache::tags(['news'])->flush();
        });

        static::deleted(function () {
            Cache::tags(['news'])->flush();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

}
