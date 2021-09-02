@extends('admin')

@section('content')
    <h2 class="pb-3 mb-4 font-italic border-bottom">
        Администрирование | Генерация отчетов
    </h2>
    <div class="h2">Список отчетов</div>
    <div class="list-group mb-5 col-4">
        <a href="{{ route('admin.reports.total') }}" class="list-group-item list-group-item-action" aria-current="true">
            Итого
        </a>
    </div>
@endsection
