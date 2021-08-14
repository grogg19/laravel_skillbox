<div class="blog-post">
    <h2 class="blog-post-title">{{ $article->title }}</h2>

    @include('tags.list', ['tags' => $article->tags])

    <p class="blog-post-meta">{{ $article->created_at->toFormattedDateString() }}</p>
    <p>{{ $article->excerpt }}</p>
    <p class="my-4">
        <a class="btn btn-primary" href="{{ route('article.edit', $article) }}">Изменить</a>
    </p>
</div>
