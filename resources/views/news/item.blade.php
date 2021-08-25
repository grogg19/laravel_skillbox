<div class="blog-post">
    <h2 class="blog-post-title">{{ $newsItem->title }}</h2>

    <p class="blog-post-meta">{{ $newsItem->created_at->toFormattedDateString() }}</p>
    <p>{{ $newsItem->excerpt }}</p>
    <a href="{{ route('news.show', ['item' => $newsItem->slug]) }}">Прочитать</a>
</div>
