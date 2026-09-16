<!DOCTYPE html>
<html>
<head>
    <title>Portfolio - @yield('title')</title>
</head>

<body>

    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @stack('scripts')

    @include('partials.card', ['judul' => 'Project GSC'])
    

</body>
</html>