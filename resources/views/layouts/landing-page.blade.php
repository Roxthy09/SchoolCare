<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">

    <!--====== Title ======-->
    <title>Advanced - App Landing Page Template</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{ asset('landing/assets/images/favicon.png')}}" type="image/png">



    <!--====== Animate CSS ======-->
    <link rel="stylesheet" href="{{ asset('landing/assets/css/animate.css')}}">



    <!--====== Line Icons CSS ======-->
    <link rel="stylesheet" href="{{ asset('landing/assets/css/LineIcons.2.0.css')}}">

    <!--====== Bootstrap CSS ======-->
    <link rel="stylesheet" href="{{ asset('landing/assets/css/bootstrap.4.5.2.min.css')}}">

    <!--====== Default CSS ======-->
    <link rel="stylesheet" href="{{ asset('landing/assets/css/default.css')}}">

    <!--====== Style CSS ======-->
    <link rel="stylesheet" href="{{ asset('landing/assets/css/style.css')}}">

</head>

<body>
    <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

    <!--====== PRELOADER PART START ======-->

    <!--====== PRELOADER PART ENDS ======-->

    <!--====== HEADER PART START ======-->
    @include('layouts.part.header')
    <!--====== HEADER PART ENDS ======-->

    <div class="main">
        @yield('content')
        @include('layouts.part.cta')
        @include('layouts.part.blog')
    </div>

    <!--====== FOOTER PART START ======-->
    @include('layouts.part.footer')
    <!--====== FOOTER PART ENDS ======-->

    <!--====== BACK TOP TOP PART START ======-->

    <a href="#" class="back-to-top"><i class="lni lni-chevron-up"></i></a>

    <!--====== BACK TOP TOP PART ENDS ======-->

    <!--====== PART START ======-->

    <!--
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-">
                    
                </div>
            </div>
        </div>
    </section>
-->

    <!--====== PART ENDS ======-->





    <!--====== Jquery js ======-->
    <script src="{{ asset('landing/assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('landing/assets/js/bootstrap.4.5.2.min.js') }}"></script>

    <script src="{{asset('landing/assets/js/vendor/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('landing/assets/js/vendor/modernizr-3.7.1.min.js')}}"></script>

    <!--====== Bootstrap js ======-->
    <script src="{{asset('landing/assets/js/popper.min.js')}}"></script>
    <script src="{{asset('landing/assets/js/bootstrap.4.5.2.min.js')}}"></script>


    <!--====== Scrolling Nav js ======-->
    <script src="{{asset('landing/assets/js/jquery.easing.min.js')}}"></script>
    <script src="{{asset('landing/assets/js/scrolling-nav.js')}}"></script>

    <!--====== wow js ======-->
    <script src="{{asset('landing/assets/js/wow.min.js')}}"></script>

    <!--====== Main js ======-->
    <script src="{{asset('landing/assets/js/main.js')}}"></script>

    <script>
        window.addEventListener("scroll", function() {
            let navbar = document.querySelector(".navbar");

            if (window.scrollY > 50) {
                navbar.classList.add("scrolled");
            } else {
                navbar.classList.remove("scrolled");
            }
        });
    </script>
    <script>
        document.addEventListener("hidden.bs.modal", function() {
            document.body.classList.remove('modal-open');
            document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
        });
    </script>
</body>

</html>