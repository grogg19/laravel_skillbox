<?php

namespace App\Repositories;

use App\Models\Tag;

class TagRepository implements TagRepositoryInterface
{
    public function tagsCloud()
    {
        return Tag::has('articles')
            ->orHas('news')
            ->get();
    }

    public function getAllTagsCount(): int
    {
        return Tag::count();
    }
}
