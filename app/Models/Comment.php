<?php

namespace App\Models;

use App\Helpers\CacheCleanable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory, CacheCleanable;

    protected $fillable = ['body', 'article_id', 'owner_id'];

    protected static $tags = ['comments'];

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function commentable()
    {
        return $this->morphTo();
    }
}
