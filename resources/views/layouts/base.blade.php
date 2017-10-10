<html>
<head>
    <title>{{ $title }}</title>

    @section('head_scripts')
        <script src="jquery.js"></script>
    @show
</head>

<body>
@section('header')
    <header>
        This is the default header.
    </header>
@show

<div class="content">
    @yield('content', 'I`m content!')
</div>

@include('blocks.footer')
</body>

</html>