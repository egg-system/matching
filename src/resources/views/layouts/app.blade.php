<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @yield('head')
</head>

<body>
    <div id="app">
        @yield('header')

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    @yield('script')
</body>

</html>
