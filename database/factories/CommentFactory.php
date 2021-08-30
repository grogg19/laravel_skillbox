<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $article = Article::orderByRaw('RAND()')->first();
        $user = User::orderByRaw('RAND()')->first();


        return [
            'body' => $this->faker->text(),
            'owner_id' => $user,
            'commentable_type' => User::class,
            'commentable_id' => $user->id,
        ];
    }
}
