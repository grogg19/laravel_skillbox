@extends('layout.main_without_sidebar')

@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        Новости
    </h3>
    @foreach($news as $newsItem)
        @include('news.item')
    @endforeach
@endsection
