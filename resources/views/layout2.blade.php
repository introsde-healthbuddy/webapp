<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
@include('partials.header')
@yield('header')

@yield('content');

@include('partials.footer')
@yield('footer')
</body>
</html>