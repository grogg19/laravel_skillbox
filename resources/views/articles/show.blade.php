@extends('layout.main')

@section('title', 'Статья | ' . $article->title )

@section('content')
    <div class="mb-4 font-italic border-bottom"></div>
    <h1>{{ $article->title }}</h1>

    @include('tags.list', ['tags' => $article->tags])

    <p class="blog-post-meta">{{ $article->created_at->toFormattedDateString() }}</p>
    {{ $article->body }}

    @include('comments.list', ['comments' => $article->comments])

    <p class="my-4">
        @can('update', $article)
            @admin
                <a class="btn btn-primary" href="{{ route('admin.article.edit', $article) }}">Изменить</a>
            @else
                <a class="btn btn-primary" href="{{ route('article.edit', $article) }}">Изменить</a>
            @endadmin
        @endcan
        <a class="btn btn-primary" href="{{ route('article.main') }}">К списку статей</a>
    </p>
@endsection
