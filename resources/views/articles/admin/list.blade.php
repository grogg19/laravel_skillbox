@extends('admin')

@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        Администрирование статей
    </h3>
    @foreach($articles as $article)
        @include('articles.admin.item')
    @endforeach
@endsection
