<div class="my-5">
    @include('errors.list')
    <form method="post" action="{{ route('admin.reports.make') }}">
        @csrf
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="articles" name="reports[articles]">
            <label class="form-check-label" for="articles">Статьи</label>
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="news" name="reports[news]">
            <label class="form-check-label" for="news">Новости</label>
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="comments" name="reports[comments]">
            <label class="form-check-label" for="comments">Комментарии</label>
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="tags" name="reports[tags]">
            <label class="form-check-label" for="tags">Теги</label>
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="users" name="reports[users]">
            <label class="form-check-label" for="users">Пользователи</label>
        </div>
        <div class="my-4">
            <button type="submit" class="btn btn-outline-primary">Сгенерировать отчет</button>
        </div>
    </form>
</div>
