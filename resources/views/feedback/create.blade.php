@extends('layouts.main')
@section('content')
    <div class="offset-2 col-8">
        <h2>Отзыв</h2>
        @if($errors->any())
            @foreach($errors->all() as $error)
                @include('inc.message', ['message' => $error])
            @endforeach
        @endif
{{-- action="{{ route('feedback.store', ['status=1']) }}"--}}
        <form method="post" >
            @csrf
            <div class="form-group">
                <label for="title">Имя пользователя</label>
                <input type="" placeholder="Имя пользователя" class="form-control" name="userName" id="userName" value="{{ old('userName') }}">
            </div>
            <div class="form-group">
                <label for="description">Отзыв</label>
                <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
            </div>
            <br>
            <button class="btn btn-success" type="submit">Отправить</button>
        </form>
    </div>
@endsection
