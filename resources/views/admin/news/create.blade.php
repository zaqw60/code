@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <h2>Добавление новости</h2>

        @include('inc.message')

        <form method="post" action="{{ route('admin.news.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="category_id">Выбрать категорию</label>
                <select name="category_id" class="form-control" id="category_id">
                    <option value="0">Выбрать</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if(old('$category_id') === $category->id) selected @endif>{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="source_id">Выбрать источник </label>
                <select name="source_id" class="form-control" id="source_id">
                    <option value="0">Выбрать</option>
                    @foreach($sources as $source)
                        <option value="{{ $source->id }}" @if(old('source_id') === $source->id) selected @endif>{{ $source->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="title">Заголовок</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
                @error('title') <span style="color: red">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="author">Автор</label>
                <input type="text" class="form-control" name="author" id="author" value="{{ old('author') }}">
                @error('author') <span style="color: red">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="status">Статус</label>
                <select class="form-control" name="status" id="status">
                    <option @if(old('status')==='ACTIVE') selected @endif>ACTIVE</option>
                    <option @if(old('status')==='DRAFT') selected @endif>DRAFT</option>
                    <option @if(old('status')==='BLOCKED') selected @endif>BLOCKED</option>
                </select>
            </div>
            <div class="form-group">
                <label for="image">Изображение</label>
                <input type="file" class="form-control" name="image" id="image">
            </div>
            <div class="form-group">
                <label for="description">Описание</label>
                <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
            </div>
            <button class="btn btn-success" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
@push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#description' ), {
                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
            })
            .catch( error => {
                console.log( error );
            });
    </script>
@endpush
