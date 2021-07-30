@extends('layout.main')

@section('title', 'Создать новую статью')

@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        Добавление новой статьи
    </h3>
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{ route('article.store') }}">
        @csrf
        @include('articles.partials.form')
    </form>
@endsection
