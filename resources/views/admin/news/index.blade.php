@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

    </div>

    <h2>Список новостей</h2>
    <div class="table-responsive">
        @include('inc.message')
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>Наименование</th>
                <th>Категория</th>
                <th>Автор</th>
                <th>Статус</th>
                <th>Источник</th>
                <th>Дата добавления</th>
                <th>Управление</th>
            </tr>
            </thead>
            <tbody>
            @forelse($newsList as $news)
            <tr>
                <td>{{ $news->id }}</td>
                <td>{{ $news->title }}</td>
                <td>{{ $news->category->title }}</td>
                <td>{{ $news->author }}</td>
                <td>{{ $news->status }}</td>
                <td>{{ $news->source->title }}</td>
                <td>{{ $news->created_at->format('d-m-Y H:i') }}</td>
                <td><a href="{{ route('admin.news.edit', ['news'=>$news]) }}">Редактировать</a> &nbsp; <a href="" style="color: fuchsia">Удалить</a></td>
            </tr>
            @empty
                <tr>
                    <td colspan="8">Новостей нема</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{ $newsList->links() }}
    </div>
    <a href="{{ route('admin.news.create') }}" class="btn btn-success" style="float: right">Добавить новость</a>
@endsection
