@include('layouts.head')
@include('layouts.header')
@include('layouts.script')

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @yield('head')
</head>

<body>
    <div class="d-flex" id="app">   
        <div class="">
            @include('gym.layouts.sidebar')
        </div>
        <div class="flex-grow-1">
            @yield('header')

            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </div>

    @yield('script')
</body>

</html>
