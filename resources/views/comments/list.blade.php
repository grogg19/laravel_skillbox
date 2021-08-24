@if($article->comments->isNotEmpty())
    <div class="h4 blog-header mt-5 mb-4 p-1">Комментарии:</div>
@endif
<div class="row">
    <div class="col-md-12">
        @forelse($article->comments as $comment)
            @include('comments.comment', ['comment'=> $comment])
        @empty
        <p class="mt-5">Комментариев пока нет </p>
        @endforelse
    </div>
</div>

