<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['name'];

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    /**
     * @return mixed
     */
    public function tagsCloud()
    {
        return (new static())->has('articles')->get();
    }

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }
}
