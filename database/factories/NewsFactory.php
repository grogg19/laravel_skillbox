<?php

namespace Database\Factories;

use App\Models\News;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $title = Str::ucfirst((string) $this->faker->words(rand(3,8), true)),
            'author_id' => 1,
            'slug' => Str::slug($title),
            'excerpt' => $this->faker->text(200),
            'body' => $this->faker->text(1000),
            'is_published' => $this->faker->boolean(),
            'created_at' => $this->faker->dateTimeBetween('-1 month', 'now')
        ];
    }
}
