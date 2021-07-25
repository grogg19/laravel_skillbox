@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        Список обращений
    </h3>
    @foreach($messages as $message)
        <div class="blog-post">
            <p class=h4>{{ $message->email }}</p>
            <p class="blog-post-meta">{{ $message->created_at->toFormattedDateString() }}</p>
            <p>{{ $message->body }}</p>
        </div>
    @endforeach
@endsection
