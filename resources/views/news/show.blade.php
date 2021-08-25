@extends('layout.main_without_sidebar')

@section('title', 'Новость | ' . $newsItem->title )

@section('content')
    <div class="mb-4 font-italic border-bottom"></div>
    <h1>{{ $newsItem->title }}</h1>

    <p class="blog-post-meta">{{ $newsItem->created_at->toFormattedDateString() }}</p>
    {{ $newsItem->body }}

    <p class="my-4">
        @can('update', $newsItem)
            @admin
                <a class="btn btn-primary" href="{{ route('admin.news.edit', $newsItem) }}">Изменить</a>
            @endadmin
        @endcan
        <a class="btn btn-primary" href="{{ route('news.main') }}">К списку новостей</a>
    </p>
@endsection
