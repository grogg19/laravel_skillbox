<?php

namespace App\Repositories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;

class TagRepository implements TagRepositoryInterface
{
    public function tagsCloud()
    {
        return Tag::has('articles')
            ->orHas('news')
            ->get();
    }
}
