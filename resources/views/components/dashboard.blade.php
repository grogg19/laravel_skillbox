@extends('layout.main_without_sidebar')

@section('title', 'Административный раздел')

@section('content')
<div class="col-12 mb-5">
    <div class="bg-white overflow-hidden shadow-sm rounded-lg min-vh-100">
        <div class="p-4 bg-white border-b border-gray-200 d-flex justify-content-start">
            <div class="card d-flex flex-row align-items-center m-3" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Список статей</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Добавление, редактирование, удаление статей</h6>
                    <a href="{{ route('admin.article.index') }}" class="card-link">Управление</a>
                </div>
            </div>
            <div class="card d-flex flex-row align-items-center m-3" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Новости</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Добавление, редактирование, удаление новостей</h6>
                    <a href="{{ route('admin.news.index') }}" class="card-link">Управление</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
