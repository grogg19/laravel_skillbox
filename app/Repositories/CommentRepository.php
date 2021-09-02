<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository implements CommentRepositoryInterface
{
    /**
     * @return int
     */
    public function getAllCommentsCount(): int
    {
        return Comment::count();
    }
}
