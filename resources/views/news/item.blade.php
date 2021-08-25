<div class="blog-post">
    <h2 class="blog-post-title">{{ $itemNews->title }}</h2>

    <p class="blog-post-meta">{{ $itemNews->created_at->toFormattedDateString() }}</p>
    <p>{{ $itemNews->excerpt }}</p>
    <a href="{{ route('news.show', ['item' => $itemNews->slug]) }}">Прочитать</a>
</div>
