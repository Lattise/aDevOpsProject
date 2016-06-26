@extends('layouts.function')

@section('content')
    <form method="post" class="form-horizontal">
        <textarea name="sql" class="form-control" rows="3"></textarea>
        <div class="form-group">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">执行</button>
            </div>
        </div>
    </form>
@endsection
