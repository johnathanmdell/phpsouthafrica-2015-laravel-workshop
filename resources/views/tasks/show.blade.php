@extends('app')

@section('content')
    <h2>{{ $task->title }}</h2>
    <hr />
    <a href="{{ route('tasks.mark', $task->id) }}" class="btn {!! $task->completed === 1 ? 'btn-warning' : 'btn-success' !!}">Mark</a>
    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-info">Edit</a>
    <a href="{{ route('tasks.destroy', $task->id) }}" class="btn btn-danger">Delete</a>
    <hr />
    <div>{!! $task->description !!}</div>
@endsection