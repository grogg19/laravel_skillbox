@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        Статьи
    </h3>
    @foreach($articles as $article)
        <div class="blog-post">
            <h2 class="blog-post-title">{{ $article->title }}</h2>
            <p class="blog-post-meta">{{ $article->created_at->toFormattedDateString() }}</p>
            <p>{{ $article->excerpt }}</p>
            <a href="{{ route('article.show', ['slug' => $article->slug]) }}">Читать статью</a>
        </div>
    @endforeach
@endsection
