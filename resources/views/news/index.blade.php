@extends('layouts.main')
@section('title') Список новостей @parent @endsection
@section('content')
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @forelse($newsList as $news)
        <div class="col">
            <div class="card shadow-sm">
                <img src="{{ Storage::disk('public')->url($news->image) }}">
                <h3>{{ $news->title }}</h3>

                <div class="card-body">
                    <p class="card-text">{!! $news->description !!}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="{{ route('news.show', ['news' => $news]) }}" class="btn btn-sm btn-outline-secondary">Подробно</a>
                        </div>
                        <small class="text-muted">{{ $news->created_at->format('d-m-Y H:i') }}--{{ $news->author }}</small>
                    </div>
                </div>
            </div>
        </div>
        @empty
            <h2>Новостей нет</h2>
        @endforelse
    </div>
    {{ $newsList->links() }}
@endsection




