<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
@include('partials.header')
@yield('header')
<body>
    <div class="be-wrapper be-fixed-sidebar">
        @include('partials.top')
        @include('partials.nav')
      
      <div class="be-content">
        <div class="main-content container-fluid">

        @yield('content')
          
        </div>
      </div>

    </div>

@include('partials.footer')
@yield('footer')
</body>
</html>