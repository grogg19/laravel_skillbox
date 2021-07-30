@extends('layout.main')

@section('title', 'Редактирование статьи')

@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        Редактирование статьи
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
    <form method="post" action="{{ route('article.update', ['article' => $article]) }}">
        @csrf
        @method('patch')
        @include('articles.partials.form')
    </form>
@endsection
