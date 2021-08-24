<form method="post" action="{{ route('article.comment.store', $article) }}" class="mt-4">
    @csrf
    <div class="mb-3">
        <label for="addComment" class="form-label fw-bolder">Оставить комментарий:</label>
        <textarea class="form-control" id="addComment" rows="3" name="body"></textarea>
    </div>
    <button type="submit" class="btn btn-primary"><i class="far fa-comment mr-2"></i> Отправить</button>
</form>
