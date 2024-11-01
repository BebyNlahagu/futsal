<!DOCTYPE html>
<!-- Coding By CodingNepal - www.codingnepalweb.com -->
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link rel="shortcut icon" href="{{ asset('masuk/futsal.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('masuk/style.css') }}">
</head>

<body>
    <div class="wrapper">
        @yield('masuk')
        @include('sweetalert::alert')
    </div>
</body>

</html>
