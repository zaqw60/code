@extends('layouts.admin')
@section('content')
<div class="offset-2 col-8">
    <h2>Добавление категории</h2>

    @include('inc.message')

    <form method="post" action="{{ route('admin.categories.store') }}">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
            @error('title') <span style="color: red">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
        </div>
        <button class="btn btn-success" type="submit">Сохранить</button>
    </form>
</div>
@endsection
