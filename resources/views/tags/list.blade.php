@php
    $tags = $tags ?? collect();
@endphp

@if ($tags->isNotEmpty())
    <div class="mb-2">
        @foreach($tags as $tag)
            <a href="{{ route('tags.selectByTag', ['tag' => $tag]) }}" class="badge badge-secondary">{{ $tag->name }}</a>
        @endforeach
    </div>
@endif
