<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Article
 * @package App\Models
 */
class Article extends Model implements HasTags
{
    use HasFactory;

    protected $guarded = [];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

}
