<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ArticleHistory extends Pivot
{
    use HasFactory;

    protected $fillable = ['article_id', 'user_id', 'before', 'after'];

    protected $casts = [
        'before' => 'array',
        'after' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

}
