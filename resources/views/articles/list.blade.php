@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        Статьи
    </h3>
    @foreach($articles as $article)
        @include('articles.item')
    @endforeach
@endsection
