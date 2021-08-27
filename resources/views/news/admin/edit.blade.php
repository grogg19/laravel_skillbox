@extends('layout.main_without_sidebar')

@section('title', 'Административный раздел | Редактирование новости ')

@section('content')
    <h2 class="pb-3 mb-4 font-italic border-bottom">
        Административный раздел | редактирование новости
    </h2>
    @include('errors.list')
    <form method="post" action="{{ route('admin.news.update', $news) }}">
        @csrf
        @method('patch')
        @include('news.partials.form')
    </form>
    <form method="post" action="{{ route('admin.news.destroy', $news) }}">
        @csrf
        @method('delete')
        <div class="form-group mb-4">
            <a class="btn btn-primary" href="{{ route('admin.news.index') }}">К списку новостей</a>
            <button type="submit" class="btn btn-dark"><i class="fas fa-trash-alt"></i></button>
        </div>
    </form>
@endsection
