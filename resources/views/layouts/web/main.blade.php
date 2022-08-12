<!DOCTYPE html>
<html lang="en">

@include('layouts.web.head')

<body>
    <!-- Topbar Start -->
    @include('layouts.web.topbar')
    <!-- Topbar End -->


    <!-- Navbar Start -->
    @include('layouts.web.navbar')
    <!-- Navbar End -->


    <!-- Carousel Start -->
    @yield('carousel')
    <!-- Carousel End -->

    <!-- Products Start -->
   @yield('content')
    <!-- Products End -->
    <!-- Footer Start -->
    @include('layouts.web.footer')
    <!-- Footer End -->


    @include('layouts.web.js')
</body>

</html>