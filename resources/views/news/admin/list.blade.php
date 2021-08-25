@extends('admin')

@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        Администрирование новостей
    </h3>
    @foreach($news as $newsItem)
        @include('news.admin.item')
    @endforeach
@endsection
