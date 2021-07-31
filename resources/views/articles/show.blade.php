@extends('layout.main')

@section('title', 'Статья | ' . $article->title )

@section('content')
    <div class="mb-4 font-italic border-bottom"></div>
    <h1>{{ $article->title }}</h1>

    @include('tags.list', ['tags' => $article->tags])

    <p class="blog-post-meta">{{ $article->created_at->toFormattedDateString() }}</p>
    {{ $article->body }}
    <p class="my-4">
        <a class="btn btn-primary" href="{{ route('article.edit', $article) }}">Изменить</a>
        <a class="btn btn-primary" href="{{ route('article.main') }}">К списку статей</a>
    </p>
@endsection
