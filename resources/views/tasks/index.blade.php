@extends('app')

@section('content')
    <h2>My Task List</h2>
    <hr />
    <form method="post" action="{{ route('tasks.store') }}">
        <div class="form-group {{ $errors->has('title') ? 'has-error' : false }}">
            <input type="text" name="title" class="form-control" id="title" placeholder="What needs to be done?" value="{{ Input::old('title', '') }}" />
            {!! $errors->has('title') ? '<span class="help-block">' . $errors->first('title') . '</span>' : '' !!}
        </div>
        {!! csrf_field() !!}
    </form>
    <table class="table table-hover">
        @if ($tasks->count() > 0)
            @foreach ($tasks as $task)
                <tr>
                    <td style="vertical-align: middle;">
                        @if ($task->completed === 1)
                            <a href="{{ route('tasks.show', $task->id) }}"><s>{{ $task->title }}</s></a>
                        @else
                            <a href="{{ route('tasks.show', $task->id) }}">{{ $task->title }}</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td>All good for now.</td>
            </tr>
        @endif
    </table>
    {!! $tasks->render() !!}
@endsection