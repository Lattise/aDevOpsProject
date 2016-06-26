@extends('layouts.function')

@section('content')
    <table id="table"
           class="table table-hover"
           data-toggle="table"
    >
        <thead>
        <tr>
            <th class="col-md-1">id</th>
            <th class="col-md-4">key</th>
            <th class="col-md-6">value</th>
            <th class="col-md-1"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($envs as $env)
            <tr>
                <td>{{ $env->id }}</td>
                <td>{{ $env->key }}</td>
                <td class="editable-value" data-pk="{{ $env->id }}" data-key="{{ $env->key }}">{{ $env->value }}</td>
                <td>
                    <button type="button" onclick="del({{ $env->id }})" class="btn btn-danger btn-sm">删除</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <form method="post" class="form-inline">
        <div class="form-group col-md-4">
            <label class="col-md-2" for="id_key">key</label>
            <input name="key" type="text" class="form-control col-md-2" id="id_key">
        </div>
        <div class="form-group col-md-4">
            <label class="col-md-2" for="id_value">value</label>
            <input name="value" type="text" class="form-control col-md-2" id="id_value">
        </div>
        <button type="submit" class="btn btn-primary">添加env</button>
    </form>

    <script>
        $.fn.editable.defaults.mode = 'inline';
        $(function () {
            $('.editable-value').editable({
                url: './env/patch'
            });
        });

        function del(id) {
            $.ajax({
                url: './env/' + id,
                type: 'DELETE',
                success: function (result) {
                    location.reload();
                }
            });
        }
    </script>


@endsection
