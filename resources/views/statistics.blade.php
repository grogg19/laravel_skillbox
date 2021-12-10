@extends ('layout.main_without_sidebar')

@section('title', 'Статистика сайта')

@section('content')
    <h2 class="pb-3 mb-4 font-italic border-bottom">
        Статистика сайта
    </h2>
        <div class="col-12 mb-5">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg min-vh-100">
                <div class="d-flex ">
                    <div class="p-2 bg-white border-gray-200 row flex-row d-flex justify-content-around">
                        <div class="card col-3 m-1" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Всего статей:</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $totalArticles }}</h6>
                            </div>
                        </div>
                        <div class="card col-3 m-1" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Всего новостей:</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $totalNews }}</h6>
                            </div>
                        </div>
                        <div class="card col-3 m-1" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Автор рекордсмен:</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $authorManiac['name'] }}</h6>
                            </div>
                        </div>
                        <div class="card col-3 m-1" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Самая длинная статья:</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $longestArticle['title'] }}</h6>
                                <h6 class="card-subtitle mb-2 text-muted">Длина: {{ $longestArticle['lengthBody'] }} символов</h6>
                                <a href="{{ route('article.show', $longestArticle['slug']) }}" class="card-link">Посмотреть</a>
                            </div>
                        </div>
                        <div class="card col-3 m-1" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Самая короткая статья:</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $shortestArticle['title'] }}</h6>
                                <h6 class="card-subtitle mb-2 text-muted">Длина: {{ $shortestArticle['lengthBody'] }} символов</h6>
                                <a href="{{ route('article.show', $shortestArticle['slug']) }}" class="card-link">Посмотреть</a>
                            </div>
                        </div>
                        <div class="card col-3 m-1" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Среднее количество статей у авторов:</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $averageQuantityArticles }} статей</h6>
                            </div>
                        </div>
                        @if($mostChangeableArticle !== null)
                        <div class="card col-3 m-1" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Самая часто изменяемая статья</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $mostChangeableArticle['title'] }}</h6>
                                <a href="{{ route('article.show', $mostChangeableArticle['slug']) }}" class="card-link">Посмотреть</a>
                            </div>
                        </div>
                        @endif
                        <div class="card col-3 m-1" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Самая обсуждаемая статья</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $mostDiscussableArticle['title'] }}</h6>
                                <a href="{{ route('article.show', $mostDiscussableArticle['slug']) }}" class="card-link">Посмотреть</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
