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
                    <td>
                        <a href="{{ route('admin.categories.edit', ['category'=>$category->id]) }}">Редактировать</a>
                        <a href="javascript:;" class="delete" rel="{{ $category->id }}" style="color: fuchsia">Удалить</a>
                    </td>
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

@push('js')
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function (){
            let elements = document.querySelectorAll(".delete");
            elements.forEach(function (e, k) {
                e.addEventListener("click", function () {
                    const id = e.getAttribute('rel');
                    if (confirm(`Подтверждаете удаление записи с #id = ${id}?`)) {
                        //send id on the server
                        send(`/admin/categories/${id}`).then(()=>{
                            location.reload();
                        })
                    }else{
                        alert("Удаление отменено")
                    }
                })
            })
        })

        async function send(url) {
            let response = await fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            let result = await response.json();
            return result.ok;
        }
    </script>
@endpush
