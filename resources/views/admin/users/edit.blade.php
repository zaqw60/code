@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <h2>Редактирование пользователя</h2>

        @include('inc.message')

        <form method="post" action="{{ route('admin.users.update', ['user'=>$user]) }}">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" class="form-control" name="name" id="name" value = "{{ $user->name }}">
                @error('name') <span style="color: red">{{ $message }}</span> @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="email">Email адрес</label>
                <input type="text" class="form-control" name="email" id="email" value = "{{ $user->email }}">
                @error('name') <span style="color: red">{{ $message }}</span> @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="is_admin">Роль</label>
                <input type="number" class="form-control" name="is_admin" id="is_admin" value = "{{ $user->is_admin }}">
                @error('name') <span style="color: red">{{ $message }}</span> @enderror
            </div>
            <br>
            <button class="btn btn-success" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
