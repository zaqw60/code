@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

    </div>

    <h2>Список новостей</h2>
    <div class="table-responsive">
        @include('inc.message', ['message' => 'Ошибка в новостях'])
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>Наименование</th>
                <th>Автор</th>
                <th>Статус</th>
                <th>Дата добавления</th>
                <th>Управление</th>
            </tr>
            </thead>
            <tbody>
            @forelse($newsList as $key => $news)
            <tr>
                <td>{{ $key }}</td>
                <td>{{ $news['title'] }}</td>
                <td>{{ $news['author'] }}</td>
                <td>DRAFT</td>
                <td>{{ $news['created_at']->format('d-m-Y H:i') }}</td>
                <td><a href="{{ route('admin.news.edit', ['news'=>$key]) }}">Редактировать</a> &nbsp; <a href="" style="color: fuchsia">Удалить</a></td>
            </tr>
            @empty
                <tr>
                    <td colspan="8">Новостей нема</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
