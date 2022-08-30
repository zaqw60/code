@extends('layouts.main')
@section('title') Новость - {{ $news->title }} @parent @endsection
@section('content')

<div style="border: 1px solid grey">
    <h2>{{ $news->title }}</h2>
    <p>{!! $news->description !!}</p>
    <p>{{ $news->created_at }}<p>{{ $news->author }}</p>
</div>
@endsection
