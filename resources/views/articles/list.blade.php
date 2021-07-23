@section('content')
    @foreach($articles as $article)
        <div class="blog-post">
            <h2 class="blog-post-title">{{ $article->title }}</h2>
            <p>{{ $article->excerpt }}</p>
            <a href="/articles/">Читать статью</a>
        </div>
    @endforeach
@endsection
