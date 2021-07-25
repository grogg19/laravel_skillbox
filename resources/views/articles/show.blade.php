@extends('layout.main')

@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        Детальная страница статьи
    </h3>
    <h1>{{ $article->title }}</h1>
    <p class="blog-post-meta">{{ $article->created_at->toFormattedDateString() }}</p>
    {{ $article->body }}
    <p>
        <a href="/">К списку статей</a>
    </p>
@endsection
