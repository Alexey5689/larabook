<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Larabook</title>
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap-theme.min.css')}}" rel="stylesheet">
    {{-- Latest compiled and minifiedJavaScript  --}}
    <script type="text/javascript"src="{{asset('js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery-3.0.0.js')}}"></script>
</head>
<body>
    {{-- @section – открывает именованную секцию; --}}
    @section('menu')
    <div class="mainmenu1 col-sm-12 col-md-12 col-lg-12">
        <ul class="nav nav-pills nav-justified">
            <li role="presentation" {{$page == 'Main page' ? 'class=active' : ''}}>
                <a href="{{url('index')}}">MainPage</a>
            </li>
            <li role="presentation" {{$page == 'Forms' ? 'class=active' : ''}}>
                <a href="{{url('block/create')}}">Content Control</a>
            </li>
        </ul>
    </div>
    {{-- @show – закрывает именованную секцию, открытую директивой @section, и сразу же выводит содержимое этой секции; --}}
    @show
    <div class="container col-sm-12 col-md-12 col-lg-12">
    {{-- @yield – выводит контент именованной секции по имени.    --}}
    @yield('content')
 </div>

</body>
</html>
