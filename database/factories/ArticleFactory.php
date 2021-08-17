<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $title = Str::ucfirst((string) $this->faker->words(rand(3,8), true)),
            'owner_id' => User::factory(),
            'slug' => Str::slug($title),
            'excerpt' => $this->faker->text(200),
            'body' => $this->faker->text,
            'is_published' => $this->faker->boolean()
        ];
    }
}
