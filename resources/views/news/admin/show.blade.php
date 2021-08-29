@extends('layout.main_without_sidebar')

@section('title', 'Администрирование новостей | ' . $news->title )

@section('content')
    <div class="mb-4 font-italic border-bottom"></div>
    <h2>Администрирование | {{ $news->title }}</h2>

    <p class="blog-post-meta">{{ $news->created_at->toFormattedDateString() }}</p>
    {{ $news->body }}
    <p class="my-4">
        @can('update', $news)
        <a class="btn btn-primary" href="{{ route('admin.news.edit', ['news' => $news->slug]) }}">Изменить</a>
        @endcan
        <a class="btn btn-primary" href="{{ route('admin.news.index') }}">К списку новостей</a>
    </p>
@endsection
