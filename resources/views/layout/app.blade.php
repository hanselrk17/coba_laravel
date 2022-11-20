<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    @yield('meta')
</head>
<body>
    <div class="wrapper">
        @yield('sidebar')
        @yield('header')
        @yield('content')
        @yield('footer')
    </div>
    @yield('switcher_wrapper')
</body>
@include('sweetalert::alert')
@yield('custom_script')
</html>