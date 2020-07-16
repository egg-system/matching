<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @yield('head')
</head>

<body>
    <div id="app"> 
        <v-app>
            @yield('body')
        </v-app>
    </div>

    {{-- 副作用を避けるため、divの外に記載 --}}
    @include('components.layouts.common.script')
</body>

</html>
