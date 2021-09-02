@component('mail::message')
# Полный отчет
<ul>
@foreach($reportItems as $item)
    <li>{{ $item['title'] }}: {{ $item['value'] }}</li>
@endforeach
</ul>
@endcomponent
