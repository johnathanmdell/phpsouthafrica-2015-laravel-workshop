@extends('app')

@section('content')
    <h2>Edit Task</h2>
    <hr />
    <form method="post" action="{{ route('tasks.update', $task->id) }}" class="form-horizontal">
        <div class="form-group {{ $errors->has('title') ? 'has-error' : false }}">
            <label for="title" class="col-sm-2 control-label">Title</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', isset($task->title) ? $task->title : '') }}" />
                {!! $errors->has('title') ? '<span class="help-block">' . $errors->first('title') . '</span>' : '' !!}
            </div>
        </div>
        <div class="form-group">
            <label for="description" class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="description" name="description" rows="15">{{ old('description', isset($task->description) ? $task->description : '') }}</textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
        {!! csrf_field() !!}
    </form>
@endsection