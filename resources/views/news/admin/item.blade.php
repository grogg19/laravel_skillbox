<div class="blog-post">
    <h2 class="blog-post-title">
        @if($newsItem->is_published)
            <i class="far fa-eye mr-2" title="Опубликовано"></i>
        @else
            <i class="far fa-eye-slash mr-2" title="Неопубликовано"></i>
        @endif
            {{ $newsItem->title }}
    </h2>

    @include('tags.list', ['tags' => $newsItem->tags])

    <p class="blog-post-meta">{{ $newsItem->created_at->toFormattedDateString() }}</p>
    <p>{{ $newsItem->excerpt }}</p>
    <p class="my-4">
        <a class="btn btn-primary" href="{{ route('admin.news.show', $newsItem) }}">Просмотр</a>
    </p>
</div>
