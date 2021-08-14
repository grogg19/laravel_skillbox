@extends('layout.main')

@section('title', 'Создать новую статью')

@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        Добавление новой статьи
    </h3>
    @include('errors.list')
    <form method="post" action="{{ route('article.store') }}">
        @csrf
        @include('articles.partials.form')
    </form>
@endsection
