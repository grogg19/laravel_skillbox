@extends('layout.main_without_sidebar')

@section('title', 'Создать новость')

@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        Административный раздел | создание новости
    </h3>
    @include('errors.list')
    <form method="post" action="{{ route('admin.news.store') }}">
        @csrf
        @include('news.partials.form')
    </form>
@endsection
