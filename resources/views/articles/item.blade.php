<div class="blog-post">
    <h2 class="blog-post-title">{{ $article->title }}</h2>

    @include('tags.list', ['tags' => $article->tags, 'typeTag' => 'articles'])
    <p class="blog-post-meta">{{ $article->created_at->toFormattedDateString() }}</p>
    <p>{{ $article->excerpt }}</p>
    <a href="{{ route('article.show', $article) }}">Читать статью</a>
</div>
