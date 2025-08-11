<!DOCTYPE html>
<html lang="{{$lang??'az'}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NACaspia</title>
    <!-- Fav Icon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('site/assets/imgs/logo/favicon.png') }}">
    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="{{ asset('site/assets/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/vendor/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/vendor/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/vendor/meanmenu.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/vendor/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/vendor/animate.min.css') }}">
    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="{{ asset('site/assets/css/stylec619.css?v=1.0') }}">
    @yield('site.css')
</head>
<body class="body-wrapper body-startup-agency font-heading-bdogrotesk-regular">

<!-- Preloader -->
<div id="preloader">
    <div id="container" class="container-preloader">
        <div class="animation-preloader">
            <div class="spinner"></div>

        </div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
</div>

<!-- Sroll to top -->
<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"></path>
    </svg>
</div>

<!-- side toggle start -->
<aside class="fix">
    <div class="side-info">
        <div class="side-info-content">
            <div class="offset-widget offset-header">
                <div class="offset-logo">
                    <a href="index.html">
                        <img src="{{ asset('site/assets/imgs/logo/logo.png') }}" alt="site logo">
                    </a>
                </div>
                <button id="side-info-close" class="side-info-close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="mobile-menu d-xl-none fix"></div>
            <div class="offset-button">
                <a href="{{ route('site.contact') }}" class="rr-btn">
            <span class="btn-wrap">
              <span class="text-one">Bizimlə Əlaqə</span>
              <span class="text-two">Bizimlə Əlaqə</span>
            </span>
                </a>
            </div>
            <div class="offset-widget-box">
                <h2 class="title">Əlaqə vasitələri</h2>
                <div class="contact-meta">
                    <div class="contact-item">
                        <span class="icon"><i class="fa-solid fa-location-dot"></i></span>
                        <span class="text">Azərbaycan, Bakı</span>
                    </div>
                    <div class="contact-item">
                        <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                        <span class="text"><a href="mailto:info@nacaspia.com">info@nacaspia.com</a></span>
                    </div>
                    <div class="contact-item">
                        <span class="icon"><i class="fa-solid fa-phone"></i></span>
                        <span class="text"><a href="tel:+994552956727">+994552956727</a></span>
                    </div>
                    <div class="contact-item">
                        <span class="icon"><i class="fa-solid fa-phone"></i></span>
                        <span class="text"><a href="tel:+994552952767">+994552952767</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>
<div class="offcanvas-overlay"></div>
<!-- side toggle end -->
<x-site.header />
@yield('site.content')
<x-site.footer />
