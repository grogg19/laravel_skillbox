@extends('admin')

@section('content')
    <h2 class="pb-3 mb-4 font-italic border-bottom">
        Администрирование | Генерация отчетов
    </h2>
        @include('reports.admin.form')
@endsection
