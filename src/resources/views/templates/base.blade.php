<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @env('production')
        @include('components.gtm.head')
    @endenv

    @yield('head')
    @include('components.layouts.common.meta')
</head>

<body>
    @env('production')
        @include('components.gtm.body')
    @endenv

    <div id="app">
        <v-app>
            @yield('body')
        </v-app>
    </div>

    {{-- 副作用を避けるため、divの外に記載 --}}
    @include('components.layouts.common.script')
</body>

</html>
