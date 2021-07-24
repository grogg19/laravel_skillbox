@section('content')
    @foreach($articles as $article)
        <div class="blog-post">
            <h2 class="blog-post-title">{{ $article->title }}</h2>
            <p class="blog-post-meta">{{ $article->created_at->toFormattedDateString() }}</p>
            <p>{{ $article->excerpt }}</p>
            <a href="/articles/{{ $article->slug }}">Читать статью</a>
        </div>
    @endforeach
@endsection
