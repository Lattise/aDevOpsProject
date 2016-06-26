@extends('layouts.function')

@section('content')
    <form method="post" class="form-horizontal">
        <input type="hidden" name="project" value="{{ $project }}">
        <div class="form-group">
            <label for="id_job" class="col-sm-2 control-label">job</label>
            <div class="col-sm-10">
                <input name="job" type="text" class="form-control" id="id_job" value="{{ $job }}">
            </div>
        </div>
        <div class="form-group">
            <label for="id_version" class="col-sm-2 control-label">version</label>
            <div class="col-sm-10">
                <input name="version" type="text" class="form-control" id="id_version" value="{{ $version }}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">执行</button>
            </div>
        </div>
    </form>



    <div id="log_panel" class="panel panel-default">
        <div class="panel-heading">执行结果</div>
        <div class="panel-body">
            <pre id="log_body"></pre>
        </div>
    </div>
    <script>
        url = '/log/{{ $id }}';
        load_log();
    </script>
@endsection
