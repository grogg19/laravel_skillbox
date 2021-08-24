<?php

namespace Database\Seeders;

use App\Events\ArticleCreated;
use App\Models\Article;
use App\Models\Comment;
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

        $users = User::factory()
            ->has(Article::factory()->count(10)
                ->afterCreating(function (Article $article) use ($tags) {
                    $article->tags()->attach(
                        $tags
                            ->shuffle()
                            ->take(rand(1,4))
                            ->pluck('id'));
                })
                ->afterCreating(function (Article $article) {

                    Comment::factory()->count(rand(2,5))->create([
                        'article_id' => $article
                    ]);
                })
                , 'articles')
            ->count(3)
            ->create()
        ;
    }
}
