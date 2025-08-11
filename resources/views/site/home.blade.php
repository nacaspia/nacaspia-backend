@extends('site.layouts.app')
@section('site.title')
@endsection
@section('site.css')
@endsection
@section('site.content')
    <main>
        <!-- hero area start  -->
        <section class="hero-area-5">
            <div class="container large">
                <div class="hero-area-5-inner section-spacing">
                    <div class="section-content-wrapper">
                        <div class="hero-video fade-anim" data-direction="left" data-delay="0.45" data-offset="100"
                             data-ease="back.out(3)">
                            <video class="title-video" loop muted autoplay playsinline>
                                <source src="https://rrdevs.net/project-video/xfire.webm" type="video/mp4">
                            </video>
                        </div>
                        <div class="section-content">
                            <div class="section-title-wrapper">
                                <div class="title-wrapper fade-anim">
                                    <h3 class="section-title font-bdogrotesk-regular char-anim">NACaspia İnformation Texnology</h3>
                                </div>
                            </div>
                            <div class="text-btn-wrapper fade-anim" data-delay="0.60">
                                <div class="text-wrapper fade-anim" data-delay="0.75">
                                    <p class="text">Sizin rəqəmsal tərəfdaşınız. Biz proqram təminatlarının hazırlanması, sistem
                                        inteqrasiyası və texnoloji konsaltinq üzrə ixtisaslaşmış IT şirkətiyik. Startaplardan tutmuş
                                        korporativ müştərilərə qədər – hər kəsə uyğun çevik və innovativ həllər təqdim edirik.</p>
                                </div>
                                <div class="btn-wrapper fade-anim" data-delay="0.90">
                                    <a href="{{ route('site.contact') }}" class="rr-btn">
                                        <span class="btn-wrap">
                                          <span class="text-one">Bizimlə Əlaqə</span>
                                          <span class="text-two">Bizimlə Əlaqə</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- hero area end  -->

        <!-- work area start  -->
        <section class="work-area-4">
            <div class="container large">
                <div class="work-area-4-inner section-spacing-top">
                    <div class="section-header fade-anim">
                        <div class="section-title-wrapper">
                            <div class="subtitle-wrapper">
                    <span class="section-subtitle">
                      <svg viewBox="0 0 99 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M1.41291 5.98894C1.41291 5.98894 3.65997 6.01383 4.51655 5.98894C7.19358 5.56824 10.4255 5.80978 13.363 5.56824C17.8256 5.20128 22.1327 4.79415 26.6187 4.79415C31.6715 4.79415 36.6774 4.21934 41.7162 4.18834C46.981 4.15594 52.2465 4.18834 57.5114 4.18834C68.6462 4.18834 79.781 4.18834 90.9158 4.18834C121.155 6.61149 47.6583 -1.30401 1 1.68408"
                            stroke="#111111" stroke-linecap="round" class="svg-elem-1"></path>
                      </svg>
                    </span>
                            </div>
                            <div class="title-wrapper">
                                <h2 class="section-title font-bdogrotesk-regular fade-anim">İdeyalarınızı bizimlə realaşdırın</h2>
                                <div class="btn-wrapper fade-anim">
                                    <a href="" class="rr-btn-underline">Yeni Lahilərimiz
                                        <span class="icon"><img src="{{ asset('site/assets/imgs/icon/icon-5.webp') }}" alt="image"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="works-wrapper-box section-spacing-top">
                        <div class="works-wrapper-4 fade-anim">
                            <div class="work-box">
                                <div class="thumb">
                                    <div class="image scale" data-cursor-text="Yenilik axtar" data-cursor-text-red>
                                        <a href="https://vurtut.com" target="_blank"><img src="{{ asset('site/assets/imgs/project/vurtut.png') }}" alt="image"></a>
                                    </div>
                                </div>
                                {{--<div class="content">
                                    <h3 class="title"><a >Vurtut.com</a></h3>
                                    <div class="meta">
                                        <span class="tag">WordPress, Themeforest</span>
                                        <span class="date">(2025)</span>
                                    </div>
                                </div>--}}
                            </div>
                            <div class="work-box">
                                <div class="thumb">
                                    <div class="image scale" data-cursor-text="Yenilik axtar" data-cursor-text-red>
                                        <a href="https://isveren.az" target="_blank"><img src="{{ asset('site/assets/imgs/project/isveren.jpg') }}" alt="image"></a>
                                    </div>
                                </div>
                                {{--<div class="content">
                                    <h3 class="title"><a >Vurtut.com</a></h3>
                                    <div class="meta">
                                        <span class="tag">WordPress, Themeforest</span>
                                        <span class="date">(2025)</span>
                                    </div>
                                </div>--}}
                            </div>
                           {{-- <div class="work-box">
                                <div class="thumb">
                                    <div class="image scale" data-cursor-text="Yenilik axtar" data-cursor-text-red>
                                        <a href="portfolio-details.html"><img src="{{ asset('site/assets/imgs/project/image-31.webp') }}" alt="image"></a>
                                    </div>
                                </div>
                                <div class="content">
                                    <h3 class="title"><a href="portfolio-details.html">Redox Digital Agency Theme</a></h3>
                                    <div class="meta">
                                        <span class="tag">Themeforest</span>
                                        <span class="date">(2025)</span>
                                    </div>
                                </div>
                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- work area end  -->

        <!-- marquee text area start  -->
        <section class="marquee-text-area">
            <div class="moving-text">
                <div class="wrapper-text">
                    <h2 class="section-title font-bdogrotesk-regular" style="color: #1040c6!important;">NACaspia İnformation Texnology</h2>
                </div>
            </div>
        </section>
        <!-- marquee text area end  -->

        <!-- about area start  -->
        <section class="about-area-4">
            <div class="container large">
                <div class="about-area-4-inner section-spacing-bottom">
                    <div class="section-header fade-anim">
                        <div class="section-title-wrapper">
                            <div class="subtitle-wrapper">
                    <span class="section-subtitle">
                      Yeniliklər qat
                      <svg viewBox="0 0 99 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M1.41291 5.98894C1.41291 5.98894 3.65997 6.01383 4.51655 5.98894C7.19358 5.56824 10.4255 5.80978 13.363 5.56824C17.8256 5.20128 22.1327 4.79415 26.6187 4.79415C31.6715 4.79415 36.6774 4.21934 41.7162 4.18834C46.981 4.15594 52.2465 4.18834 57.5114 4.18834C68.6462 4.18834 79.781 4.18834 90.9158 4.18834C121.155 6.61149 47.6583 -1.30401 1 1.68408"
                            stroke="#111111" stroke-linecap="round" class="svg-elem-1"></path>
                      </svg>
                    </span>
                            </div>
                            <div class="title-wrapper">
                                <h2 class="section-title font-bdogrotesk-regular fade-anim">NACaspia yalnız texniki həllər təqdim etmir – həm də biznesinizi rəqəmsal məkanda tanıdan və
                                    inkişaf etdirən güclü marketinq alətləri ilə sizi müşayiət edir.
                                </h2>
                                <div class="btn-wrapper fade-anim">
                                    <a href="{{ route('site.about') }}" class="rr-btn">
                        <span class="btn-wrap">
                          <span class="text-one">Daha ətraflı</span>
                          <span class="text-two">Daha ətraflı</span>
                        </span>
                                    </a>
                                    <a href="{{ route('site.contact') }}" class="rr-btn-underline">Əlaqə saxla
                                        <span class="icon"><img src="{{ asset('site/assets/imgs/icon/icon-5.webp') }}" alt="image"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="thumb parallax-view go_full">
                        <img src="{{ asset('site/assets/imgs/gallery/image-51.webp') }}" alt="image" data-speed="0.8">
                    </div>
                </div>
            </div>
        </section>
        <!-- about area end  -->

        <!-- service area start  -->
        <section class="service-area-5">
            <div class="container large">
                <div class="service-area-5-inner section-spacing-top">
                    <div class="section-header fade-anim">
                        <div class="section-title-wrapper">
                            <div class="subtitle-wrapper">
                    <span class="section-subtitle">
                      Xidmətlər
                      <svg viewBox="0 0 99 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M1.41291 5.98894C1.41291 5.98894 3.65997 6.01383 4.51655 5.98894C7.19358 5.56824 10.4255 5.80978 13.363 5.56824C17.8256 5.20128 22.1327 4.79415 26.6187 4.79415C31.6715 4.79415 36.6774 4.21934 41.7162 4.18834C46.981 4.15594 52.2465 4.18834 57.5114 4.18834C68.6462 4.18834 79.781 4.18834 90.9158 4.18834C121.155 6.61149 47.6583 -1.30401 1 1.68408"
                            stroke="#111111" stroke-linecap="round" class="svg-elem-1"></path>
                      </svg>
                    </span>
                            </div>
                            <div class="title-wrapper tt_title_anim">
                                <h2 class="section-title font-bdogrotesk-regular">Xidmətlər</h2>
                            </div>
                        </div>
                    </div>
                    <div class="services-wrapper-box">
                        <div class="text-wrapper fade-anim">
                            <p class="info-text">Xidmətlərimizdən yararlanın.</p>
                        </div>
                        <div class="services-wrapper-5">
                            <a >
                                <div class="service-box fade-anim">
                                    <div class="count">
                                        <span class="number">(001)</span>
                                    </div>

                                    <div class="content">
                                        <h3 class="title">Veb sayt və platforma hazırlanması</h3>
                                        <p class="text">
                                            Korporativ veb saytlar, E-ticarət sistemləri, Portallar və idarəetmə panelləri
                                        </p>
                                    </div>
                                    <div class="thumb">
                                        <img src="{{ asset('site/assets/imgs/project/image-47.webp') }}" alt="image">
                                    </div>
                                </div>
                            </a>
                            <a  >
                                <div class="service-box fade-anim">
                                    <div class="count">
                                        <span class="number">(002)</span>
                                    </div>

                                    <div class="content">
                                        <h3 class="title">Mobil tətbiqlərin hazırlanması</h3>
                                        <p class="text">Android və iOS tətbiqləri, Cross-platform</p>
                                    </div>
                                    <div class="thumb">
                                        <img src="{{ asset('site/assets/imgs/project/image-51.webp') }}" alt="image">
                                    </div>
                                </div>
                            </a>
                            <a >
                                <div class="service-box fade-anim">
                                    <div class="count">
                                        <span class="number">(003)</span>
                                    </div>

                                    <div class="content">
                                        <h3 class="title">ERP və CRM sistemləri</h3>
                                        <p class="text">
                                            Müəssisə resurslarının və Müştəri münasibətlərinin idarə sistemləri, Fərdi dashboard və hesabatlama modulları
                                        </p>
                                    </div>
                                    <div class="thumb">
                                        <img src="{{ asset('site/assets/imgs/project/image-49.webp') }}" alt="image">
                                    </div>
                                </div>
                            </a>
                            <a >
                                <div class="service-box fade-anim">
                                    <div class="count">
                                        <span class="number">(004)</span>
                                    </div>

                                    <div class="content">
                                        <h3 class="title">İnteqrasiya və avtomatlaşdırma</h3>
                                        <p class="text">Digər sistemlərlə inteqrasiya, API və payment gateway-lərin qoşulması</p>
                                    </div>
                                    <div class="thumb">
                                        <img src="{{ asset('site/assets/imgs/project/image-50.webp') }}" alt="image">
                                    </div>
                                </div>
                            </a>
                            <a >
                                <div class="service-box fade-anim">
                                    <div class="count">
                                        <span class="number">(005)</span>
                                    </div>

                                    <div class="content">
                                        <h3 class="title">IT konsaltinq və texniki dəstək</h3>
                                        <p class="text">Texniki strategiyanın hazırlanması, İT audit və risk analizi, Uzunmüddətli texniki dəstək</p>
                                    </div>
                                    <div class="thumb">
                                        <img src="{{ asset('site/assets/imgs/project/image-51.webp') }}" alt="image">
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- service area end  -->

        <!-- cta area start  -->
        <section class="cta-area-4">
            <div class="container large">
                <div class="cta-area-4-inner section-spacing-top">
                    {{--<div class="section-header fade-anim" data-direction="left">
                        <div class="section-title-wrapper">
                            <div class="title-wrapper">
                                <h2 class="section-title font-bdogrotesk-regular" >
                                    <a href="contact.html">Let’s
                                        <span class="icon">
                                          <img class="first" src="{{ asset('site/assets/imgs/icon/icon-9.webp') }}" alt="">
                                          <img class="second" src="{{ asset('site/assets/imgs/icon/icon-9.webp') }}" alt="">
                                        </span> <br>
                                        build a brand now
                                    </a>
                                </h2>
                            </div>
                        </div>
                    </div>--}}
                </div>
            </div>
        </section>
        <!-- cta area end  -->

    </main>
@endsection
@section('site.js')
@endsection
