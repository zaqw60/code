@extends('layouts.admin')
@section('content')
    <h2>Список категорий</h2>
    <div class="table-responsive">
        @include('inc.message')
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>Наименование</th>
                <th>Дата добавления</th>
                <th>Управление</th>
            </tr>
            </thead>
            <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->title }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td><a href="{{ route('admin.categories.edit', ['category'=>$category->id]) }}">Редактировать</a> &nbsp; <a href="" style="color: fuchsia">Удалить</a></td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Новостей нема</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        {{ $categories->links() }}
    </div>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-success" style="float: right">Добавить категорию</a>
@endsection

