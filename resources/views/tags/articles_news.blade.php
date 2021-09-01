@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-6">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Статьи
        </h3>
        @foreach($articles as $article)
            @include('articles.item')
        @endforeach
    </div>
    <div class="col-6">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Новости
        </h3>
        @foreach($news as $newsItem)
            @include('news.item')
        @endforeach
    </div>
</div>
@endsection

