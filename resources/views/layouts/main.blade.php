<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Simple Ecommerce" />
    <meta name="author" content="Rama Rahmat Wijaya" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Wings Techtest</title>
    @stack('prepend-style')
    @include('includes.style')
    @stack('addon-style')
</head>

<body>
    @include('includes.navbar')
    @yield('content')
    {{-- @include('includes.footer') --}}
    @stack('prepend-script')
    @include('includes.script')
    @stack('addon-script')
    <script>
        $("#menu-toggle").click(function (e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
</body>

</html>
