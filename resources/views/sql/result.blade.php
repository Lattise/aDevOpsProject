@extends('layouts.function')

@section('content')
    <form method="post" class="form-horizontal">
        <textarea name="sql" class="form-control" rows="3">{{ $sql }}</textarea>
        <div class="form-group">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">执行</button>
            </div>
        </div>
    </form>

    @if ($success)
        <div class="panel panel-success">
            <div class="panel-heading">执行成功</div>
            <div class="panel-body">
                {{ $message }}
            </div>
        </div>
    @else
        <div class="panel panel-danger">
            <div class="panel-heading">执行失败</div>
            <div class="panel-body">
                {{ $message }}
            </div>
        </div>
    @endif
@endsection
