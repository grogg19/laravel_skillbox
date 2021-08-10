@component('mail::message')
# Обновление статьи

Статья "{{ $article->title }}" была обновлена

Краткое описание:
{{ $article->excerpt }}

@component('mail::button', ['url' => route('article.show', $article)])
Ссылка на статью
@endcomponent

From Events Notifier
@endcomponent
