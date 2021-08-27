@extends('layout.main_without_sidebar')

@section('title', 'Новость | ' . $news->title )

@section('content')
    <div class="mb-4 font-italic border-bottom"></div>
    <h1>{{ $news->title }}</h1>

    <p class="blog-post-meta">{{ $news->created_at->toFormattedDateString() }}</p>
    {{ $news->body }}

    <p class="my-4">
        @can('update', $news)
            @admin
                <a class="btn btn-primary" href="{{ route('admin.news.edit', $news) }}">Изменить</a>
            @endadmin
        @endcan
        <a class="btn btn-primary" href="{{ route('news.main') }}">К списку новостей</a>
    </p>
@endsection
