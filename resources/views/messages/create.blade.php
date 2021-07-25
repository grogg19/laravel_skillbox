@extends('layout.main')

@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        Отправить сообщение
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
    <form method="post" action="/contacts/store">
        @csrf
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Введите email" />
        </div>
        <div class="form-group">
            <label for="body">Текст сообщения:</label>
            <textarea class="form-control" id="body" rows="3" name="body"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Отправить</button>
        </div>
    </form>
@endsection
