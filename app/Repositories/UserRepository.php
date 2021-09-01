<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAuthorManiac()
    {
        return User::withCount('articles')
            ->orderByDesc('articles_count')
            ->first();
    }
}
