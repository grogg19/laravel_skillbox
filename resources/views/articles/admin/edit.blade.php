@extends('layout.main')

@section('title', 'Административный раздел | Редактирование статьи ')

@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        Административный раздел | редактирование статьи
    </h3>
    @include('errors.list')
    <form method="post" action="{{ route('admin.article.update', $article) }}">
        @csrf
        @method('patch')
        @include('articles.partials.form')
    </form>
    <form method="post" action="{{ route('article.destroy', $article) }}">
        @csrf
        @method('delete')
        <div class="form-group mb-4">
            <a class="btn btn-primary" href="{{ route('admin.article.index') }}">К списку статей</a>
            <button type="submit" class="btn btn-dark"><i class="fas fa-trash-alt"></i></button>
        </div>
    </form>
@endsection
