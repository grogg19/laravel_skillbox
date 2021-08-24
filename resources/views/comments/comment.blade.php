<div class="card p-3 mb-3">
    <div class="block">
        <b class="text-dark">{{ $comment->user->name }}</b>
    </div>
    <div class="mb-2">
        <small class="text-muted">{{ $comment->created_at->format('H:i, M d, Y') }}</small>
    </div>
    <div>
        <small class="font-weight-bold">{{ $comment->body }}</small>
    </div>
</div>
