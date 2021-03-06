<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param Article $article
     * @return bool
     */
    public function show(User $user, Article $article)
    {
        return  $user->id === $article->owner_id || $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     * @param User $user
     * @param Article $article
     * @return bool
     */
    public function update(User $user, Article $article)
    {
        return $user->id === $article->owner_id || $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Article $article
     * @return bool
     */
    public function delete(User $user, Article $article)
    {
        return $user->id === $article->owner_id || $user->isAdmin();
    }
}
