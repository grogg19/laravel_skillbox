@component('mail::message')
# Полный отчет
<ul>
@foreach($reportItems as $item)
    <li>{{ $item->name }}: {{ $item->value }}</li>
@endforeach
</ul>
@endcomponent
