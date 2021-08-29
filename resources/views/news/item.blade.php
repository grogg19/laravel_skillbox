<div class="blog-post">
    <h2 class="blog-post-title">{{ $newsItem->title }}</h2>

    @include('tags.list', ['tags' => $newsItem->tags])

    <p class="blog-post-meta">{{ $newsItem->created_at->toFormattedDateString() }}</p>
    <p>{{ $newsItem->excerpt }}</p>
    <a href="{{ route('news.show', ['news' => $newsItem->slug]) }}">Прочитать</a>
</div>
