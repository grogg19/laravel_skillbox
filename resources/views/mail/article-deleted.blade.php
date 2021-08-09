@component('mail::message')
# Статья "{{ $article->title }}" была удалена

Краткое описание:
{{ $article->excerpt }}

From Events Notifier
@endcomponent
