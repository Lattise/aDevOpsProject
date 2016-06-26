@extends('layouts.function')

@section('content')
    <form method="post" class="form-horizontal">
        <input type="hidden" name="project" value="{{ $project }}">
        <div class="form-group">
            <label for="id_version" class="col-sm-2 control-label">version</label>
            <div class="col-sm-10">
                <input name="version" type="text" class="form-control" id="id_version"
                       value="{{ $version or "" }}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">切换</button>
            </div>
        </div>
    </form>
@endsection
