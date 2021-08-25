<div class="blog-post">
    <h2 class="blog-post-title">{{ $newsItem->title }}</h2>

    <p class="blog-post-meta">{{ $newsItem->created_at->toFormattedDateString() }}</p>
    <p>{{ $newsItem->excerpt }}</p>
    <p class="my-4">
        <a class="btn btn-primary" href="{{ route('admin.news.show', $newsItem) }}">Просмотр</a>
    </p>
</div>
