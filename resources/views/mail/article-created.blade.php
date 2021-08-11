@component('mail::message')
# Создана новая статья

<h2>{{ $article->title }}</h2>

Краткое описание:
{{ $article->excerpt }}

@component('mail::button', ['url' => route('article.show', $article)])
Ссылка на статью
@endcomponent

From Events Notifier
@endcomponent
