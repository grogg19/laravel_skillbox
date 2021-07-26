@extends('layout.main')

@section('title', 'Создать новую статью')

@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        Добавление новой статьи
    </h3>
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="/articles/store">
        @csrf
        <div class="form-group">
            <label for="title">Заголовок:</label>
            <input type="text" class="form-control data-source-slugify" id="title" name="title" placeholder="Введите заголовок статьи" />
        </div>
        <div class="form-group">
            <label for="slug">Slug:</label>
            <input type="text" class="form-control data-target-slugify" id="slug" name="slug" placeholder="-slug-" />
        </div>
        <div class="form-group">
            <label for="excerpt">Краткое содержание:</label>
            <textarea class="form-control" id="excerpt" rows="3" name="excerpt" placeholder="Краткое описание"></textarea>
        </div>
        <div class="form-group">
            <label for="excerpt">Текст статьи:</label>
            <textarea class="form-control" id="body" rows="3" name="body"></textarea>
        </div>
        <div class="custom-control custom-checkbox form-group">
            <input type="checkbox" class="custom-control-input" id="is_published" name="is_published">
            <label class="custom-control-label" for="is_published">Опубликовать</label>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
@endsection
