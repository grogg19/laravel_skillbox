<?php

namespace Database\Seeders;

use App\Events\ArticleCreated;
use App\Models\Article;
use App\Models\Comment;
use App\Models\News;
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

        News::factory()
            ->count(60)
            ->hasComments(rand(2,5))
            ->afterCreating(function (News $news) use ($tags) {
                $news->tags()->attach(
                    $tags
                        ->shuffle()
                        ->take(rand(1,4))
                        ->pluck('id')
                );
            })
            ->create();

        User::factory()
            ->has(Article::factory()->count(rand(15,25))
                ->hasComments(rand(2,5))
                ->afterCreating(function (Article $article) use ($tags) {
                    $article->tags()->attach(
                        $tags
                            ->shuffle()
                            ->take(rand(1,4))
                            ->pluck('id'));
                }), 'articles')
            ->count(3)
            ->create()
        ;

    }
}
