@extends('admin')

@section('content')
    <h2 class="pb-3 mb-4 font-italic border-bottom">
        Администрирование | Отчеты | Генерация полного отчета
    </h2>
    @include('reports.admin.form')
    <report-statistics u-id="{{ auth()->user()->id }}"></report-statistics>
@endsection
