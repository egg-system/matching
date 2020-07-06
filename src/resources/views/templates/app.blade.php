<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('components.layouts.head')
</head>

<body>
    <div class="d-flex" id="app">   
        @can('gym', \Auth::user())
            <div class="">
                @include('components.layouts.sidebar')
            </div>
        @endcan
        <div class="flex-grow-1">
            @include('components.layouts.header')

            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </div>

    @include('components.layouts.script')
</body>

</html>
