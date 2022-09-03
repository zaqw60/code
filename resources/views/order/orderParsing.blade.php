@extends('layouts.main')
@section('content')
    <div class="offset-2 col-8">
        <h2>Заказ на получение выгрузки данных</h2>
        @if($errors->any())
            @foreach($errors->all() as $error)
                @include('inc.message', ['message' => $error])
            @endforeach
        @endif
        <form method="post" action="{{ route('order.store', ['status=1']) }}">
            @csrf
            <div class="form-group">
                <label for="title">Имя пользователя</label>
                <input type="text" placeholder="Имя пользователя" class="form-control" name="userName" id="userName" value="{{ old('userName') }}">
            </div>
            <div class="form-group">
                <label for="title">Телефон пользователя</label>
                <input type="tel" placeholder="Телефон" class="form-control" name="phone" id="phone" value="{{ old('phone') }}">
            </div>
            <div class="form-group">
                <label for="title">Email пользователя</label>
                <input type="email" placeholder="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label for="description">Желаемые данные</label>
                <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
            </div>
            <br>
            <button class="btn btn-success" type="submit">Отправить</button>
        </form>
    </div>
@endsection
