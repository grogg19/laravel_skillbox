@if($comments->isNotEmpty())
    <div class="h4 blog-header mt-5 mb-4">Комментарии:</div>
@endif
<div class="row">
    <div class="col-md-12">
        @forelse($comments as $comment)
            @include('comments.comment', ['comment'=> $comment])
        @empty
        <p>Нет ни одного комментария </p>
        @endforelse
    </div>
</div>

