@extends('admin')

@section('content')
    <h2 class="pb-3 mb-4 font-italic border-bottom">
        Администрирование новостей
    </h2>
    @foreach($news as $newsItem)
        @include('news.admin.item')
    @endforeach
@endsection
