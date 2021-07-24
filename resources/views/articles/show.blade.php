@extends('layout.main')

@section('content')
    <h1>{{ $article->title }}</h1>
    <p class="blog-post-meta">{{ $article->created_at->toFormattedDateString() }}</p>
    {{ $article->body }}
    <p>
        <a href="/">К списку статей</a>
    </p>
@endsection
