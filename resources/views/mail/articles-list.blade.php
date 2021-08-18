@component('mail::message')
# Список новых опубликованных статей за период
<ol>
@foreach($articles as $article)
    <li>
        <div>
            <a href="{{ route('article.show', $article) }}">{{ $article->title }}</a><br>
            <small>Дата публикации: {{ $article->created_at->format('d.m.Y H:i') }}</small>
        </div>
    </li>
@endforeach
</ol>
С уважением,<br>
{{ config('app.name') }}
@endcomponent
