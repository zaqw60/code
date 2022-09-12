@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

    </div>

    <h2>Список пользователей</h2>
    <div class="table-responsive">
        @include('inc.message')
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Дата создания</th>
                <th>Роль</th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->is_admin }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', ['user'=>$user]) }}">Редактировать</a>
{{--                        <a href="javascript:;" class="delete" rel="{{ $news->id }}" style="color: fuchsia">Удалить</a>--}}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Новостей нема</td>
                </tr>
            @endforelse
            </tbody>
        </table>
{{--        {{ $users->links() }}--}}
    </div>
{{--    <a href="{{ route('admin.news.create') }}" class="btn btn-success" style="float: right">Добавить пользователя</a>--}}
@endsection
