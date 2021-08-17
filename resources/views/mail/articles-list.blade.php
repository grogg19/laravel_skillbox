@component('mail::message')
# Список новых опубликованных статей за период

<ol>
@foreach($articles as $article)
    <li>
        <a href="{{ route('article.show', $article) }}">{{ $article->title }}</a>
        <small>Дата публикации: {{ $article->created_at }}</small>
    </li>
@endforeach
</ol>
С уважением,<br>
{{ config('app.name') }}
@endcomponent
