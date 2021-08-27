<div class="form-group">
    <label for="title">Заголовок:</label>
    <input type="text" class="form-control data-source-slugify" id="title" name="title" placeholder="Введите заголовок новости" value="{{ old('title', $news->title ?? '') }}"/>
</div>
<div class="form-group">
    <label for="slug">Slug:</label>
    <input type="text" class="form-control data-target-slugify" id="slug" name="slug" placeholder="-slug-" value="{{ old('slug', $news->slug ?? '') }}"/>
</div>
<div class="form-group">
    <label for="excerpt">Краткое содержание:</label>
    <textarea class="form-control" id="excerpt" rows="3" name="excerpt" >{{ old('excerpt', $news->excerpt ?? '') }}</textarea>
</div>
<div class="form-group">
    <label for="body">Текст статьи:</label>
    <textarea class="form-control" id="body" rows="3" name="body">{{ old('body', $news->body ?? '') }}</textarea>
</div>
<div class="custom-control custom-checkbox form-group">
    <input type="checkbox" class="custom-control-input" id="is_published" name="is_published" {{ old('is_published', $news->is_published ?? '') ? 'checked' : '' }}>
    <label class="custom-control-label" for="is_published">Опубликовать</label>
</div>
<div class="form-group mb-5">
    <button type="submit" class="btn btn-primary">Сохранить</button>
</div>
