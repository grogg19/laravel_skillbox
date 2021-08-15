<div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between">
        <a class="p-2 text-muted" href="{{ route('article.main') }}">Главная</a>
        <a class="p-2 text-muted" href="{{ route('page.about') }}">О нас</a>
        @auth()
            @admin
                <a class="p-2 text-muted" href="{{ route('admin.article.create') }}">Создать статью</a>
            @else
                <a class="p-2 text-muted" href="{{ route('article.create') }}">Создать статью</a>
            @endadmin
        @endauth
        <a class="p-2 text-muted" href="{{ route('page.contacts') }}">Контакты</a>
        <a class="p-2 text-muted" href="{{ route('page.feedback') }}">Список обращений</a>
        @admin
        <a class="p-2 text-muted" href="{{ route('admin.index') }}">Админ. раздел</a>
        @endadmin
    </nav>
</div>
