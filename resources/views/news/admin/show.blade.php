@extends('layout.main_without_sidebar')

@section('title', 'Администрирование новостей | ' . $newsItem->title )

@section('content')
    <div class="mb-4 font-italic border-bottom"></div>
    <h1>Администрирование | {{ $newsItem->title }}</h1>

    <p class="blog-post-meta">{{ $newsItem->created_at->toFormattedDateString() }}</p>
    {{ $newsItem->body }}
    <p class="my-4">
        @can('update', $newsItem)
        <a class="btn btn-primary" href="{{ route('admin.news.edit', $newsItem) }}">Изменить</a>
        @endcan
        <a class="btn btn-primary" href="{{ route('admin.news.index') }}">К списку новостей</a>
    </p>
@endsection
