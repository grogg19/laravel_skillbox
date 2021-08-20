<?php

namespace Database\Seeders;

use App\Events\ArticleCreated;
use App\Models\Article;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::getEventDispatcher()->forget(ArticleCreated::class);

        $tags = Tag::factory()->count(10)->create();

        User::factory()->count(3)->create()->each(
            function (User $user) use ($tags){
                Article::factory()->count(10)->create([
                    'owner_id' => $user
                ])->each(function (Article $article) use ($tags) {
                    $article->tags()->attach(
                        $tags
                            ->shuffle()
                            ->take(rand(1,4))
                            ->pluck('id'));
                });
            }
        );
    }
}
