@extends('layout.main_without_sidebar')

@section('title', 'Новость | ' . $itemNews->title )

@section('content')
    <div class="mb-4 font-italic border-bottom"></div>
    <h1>{{ $itemNews->title }}</h1>

    <p class="blog-post-meta">{{ $itemNews->created_at->toFormattedDateString() }}</p>
    {{ $itemNews->body }}

    <p class="my-4">
        @can('update', $itemNews)
            @admin
                <a class="btn btn-primary" href="{{ route('admin.news.edit', $itemNews) }}">Изменить</a>
            @endadmin
        @endcan
        <a class="btn btn-primary" href="{{ route('news.main') }}">К списку статей</a>
    </p>
@endsection
