<!doctype html>
<html lang="ru">


@include('components.head')

<body>
    @include('components.header')
    <main>
        <div class="container m-lg-3">
            @yield('main')
        </div>
    </main>
    @include('components.script')
</body>

</html>