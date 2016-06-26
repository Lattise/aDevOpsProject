<html lang="zh-CN">
<head>
    <title>上线系统 - {{ $project }} - {{ $func }}</title>
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap-theme.css">
    <script src="//cdn.bootcss.com/jquery/1.11.0/jquery.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.js"></script>


    <link href="//cdn.bootcss.com/x-editable/1.5.1/bootstrap3-editable/css/bootstrap-editable.css"
          rel="stylesheet"/>
    <script src="//cdn.bootcss.com/x-editable/1.5.1/bootstrap3-editable/js/bootstrap-editable.js"></script>

    <script>
        var re = /Exit Code: (\d+)/m;
        function load_log() {
            $("#log_body").load(url);
            if ((m = re.exec($("#log_body").text())) !== null) {
                if (m.index === re.lastIndex) {
                    re.lastIndex++;
                }
                if (m[1] == '0') {
                    $("#log_panel").removeClass('panel-default').addClass('panel-success');
                } else {
                    $("#log_panel").removeClass('panel-default').addClass('panel-danger');
                }
            } else {
                setTimeout(load_log, 1000);
            }
        }
    </script>
</head>
<body style="padding-top: 70px;">
<header class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-6" aria-expanded="false">
                <span class="sr-only">项目列表</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">上线系统</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-6">
            <ul class="nav navbar-nav">
                <li @if ($project == 'angejia')
                    class="active"
                        @endif
                ><a href="{{ route('project', ['project' => 'angejia']) }}">安个家</a></li>
                <li @if ($project == 'retrx-mgt')
                    class="active"
                        @endif
                ><a href="{{ route('project', ['project' => 'retrx-mgt']) }}">交易系统</a></li>
                <li @if ($project == 'account')
                    class="active"
                        @endif
                ><a href="{{ route('project', ['project' => 'account']) }}">账户系统</a></li>
                <li @if ($project == 'hr')
                    class="active"
                        @endif
                ><a href="{{ route('project', ['project' => 'hr']) }}">HR系统</a></li>
                <li @if ($project == 'okrs')
                    class="active"
                        @endif
                ><a href="{{ route('project', ['project' => 'okrs']) }}">OKRS</a></li>
            </ul>
        </div>
    </div>
</header>
<div class="container">
    @yield('funcs')
    @yield('content')
</div>
</body>
</html>
