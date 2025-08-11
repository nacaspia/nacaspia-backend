<!-- Header area start -->
<header class="header-area-5">
    <div class="header-main">
        <div class="container large">
            <div class="header-area-5__inner">
                <div class="header__logo">
                    <a href="{{ route('site.index') }}">
                        <img src="{{ asset('site/assets/imgs/logo/logo.png') }}" class="normal-logo" alt="Site Logo">
                    </a>
                </div>
                <div class="header__nav">
                    <nav class="main-menu">
                        <ul>
                            <li><a href="{{ route('site.about') }}">Haqqımızda</a></li>
{{--                            <li><a href="{{ route('site.about') }}">Xidmətlər</a></li>--}}
{{--                            <li><a href="{{ route('site.contact') }}">Yeniliklər</a></li>--}}
                            <li><a href="{{ route('site.projects') }}">Lahiyələrimiz</a></li>
                            <li><a href="{{ route('site.contact') }}">Bizimlə Əlaqə</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="header__navicon d-xl-none">
                    <button class="side-toggle"><img src="{{ asset('site/assets/imgs/icon/icon-11.webp') }}" alt="image"></button>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Header area end -->
<div class="has-smooth" id="has_smooth"></div>
<div id="smooth-wrapper">
    <div id="smooth-content">
