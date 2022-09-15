@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <h2>Редактирование новости</h2>

        @include('inc.message')

        <form method="post" action="{{ route('admin.news.update', ['news'=> $news]) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="category_id">Выбрать категорию</label>
                <select class="form-control" name="category_id" id="category_id">
                    <option value="0">Выбрать</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if($news->category_id === $category->id) selected @endif>{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="source_id">Выбрать источник</label>
                <select class="form-control" name="source_id" id="source_id">
                    <option value="0">Выбрать</option>
                    @foreach($sources as $source)
                        <option value="{{ $source->id }}" @if($news->source_id === $source->id) selected @endif>{{ $source->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="title">Заголовок</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ $news->title }}">
                @error('title') <span style="color: red">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="author">Автор</label>
                <input type="text" class="form-control" name="author" id="author" value="{{ $news->author }}">
                @error('author') <span style="color: red">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="status">Статус</label>
                <select class="form-control" name="status" id="status">
                    <option @if($news->status==='ACTIVE') selected @endif>ACTIVE</option>
                    <option @if($news->status==='DRAFT') selected @endif>DRAFT</option>
                    <option @if($news->status==='BLOCKED') selected @endif>BLOCKED</option>
                </select>
            </div>
            <div class="form-group">
                <label for="image">Изображение</label>
                <input type="file" class="form-control" name="image" id="image">
                @error('image') <span style="color: red">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="description">Описание</label>
                <textarea class="form-control" name="description" id="description">{{ $news->description }}</textarea>
            </div>
            <button class="btn btn-success" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
