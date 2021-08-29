@php
    $tags = $tags ?? collect();
@endphp

@if ($tags->isNotEmpty())
    <div class="mb-2">
        @foreach($tags as $tag)
            @if(isset($tag->pivot->taggable_type))
                <a href="{{ route( 'tags.' . $tag->pivot->taggable_type . '.selectByTag', ['tag' => $tag]) }}" class="badge badge-secondary">{{ $tag->name }}</a>
            @else
                <a href="{{ route( 'tags.selectByTag', ['tag' => $tag]) }}" class="badge badge-secondary">{{ $tag->name }}</a>
            @endif
        @endforeach
    </div>
@endif
