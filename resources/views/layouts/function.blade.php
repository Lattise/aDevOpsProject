@extends('layouts.master')

@section('funcs')
    <ul class="nav nav-tabs">
        <li role="presentation"
            @if ($func == 'deploy')
            class="active"
                @endif
        ><a href="{{ route('deploy', ['project' => $project]) }}">发布版本</a></li>
        <li role="presentation"
            @if ($func == 'fire')
            class="active"
                @endif
        ><a href="{{ route('fire', ['project' => $project]) }}">切换版本</a></li>
        <li role="presentation"
            @if ($func == 'sql')
            class="active"
                @endif
        ><a href="{{ route('sql', ['project' => $project]) }}">sql执行</a></li>
        <li role="presentation"
            @if ($func == 'job')
            class="active"
                @endif
        ><a href="{{ route('job', ['project' => $project]) }}">job执行</a></li>
        <li role="presentation"
            @if ($func == 'env')
            class="active"
                @endif
        ><a href="{{ route('env', ['project' => $project]) }}">env编辑</a></li>
    </ul>
@endsection
