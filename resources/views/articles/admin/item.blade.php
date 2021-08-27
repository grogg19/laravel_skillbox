<div class="blog-post">
    <h2 class="blog-post-title">
        @if($article->is_published)
            <i class="far fa-eye mr-2" title="Опубликовано"></i>
        @else
            <i class="far fa-eye-slash mr-2" title="Неопубликовано"></i>
        @endif
        {{ $article->title }}
    </h2>

    @include('tags.list', ['tags' => $article->tags])

    <p class="blog-post-meta">{{ $article->created_at->toFormattedDateString() }}</p>
    <p>{{ $article->excerpt }}</p>
    <p class="my-4">
        <a class="btn btn-primary" href="{{ route('admin.article.show', $article) }}">Показать</a>
    </p>
</div>
