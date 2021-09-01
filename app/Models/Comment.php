<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'article_id', 'owner_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function article()
    {
        return $this->mo(Article::class);
    }

    public function commentable()
    {
        return $this->morphTo();
    }
}
