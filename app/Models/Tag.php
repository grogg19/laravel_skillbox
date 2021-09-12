<?php

namespace App\Models;

use App\Helpers\CacheCleanable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    use CacheCleanable;

    /**
     * @var string[]
     */
    protected $fillable = ['name'];

    protected static $tags = ['tags'];

    public function articles()
    {
        return $this->morphedByMany(Article::class, 'taggable');
    }

    public function news()
    {
        return $this->morphedByMany(News::class, 'taggable');
    }

    public function taggable()
    {
        return $this->morphTo();
    }

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }


}
