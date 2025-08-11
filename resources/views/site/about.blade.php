@extends('site.layouts.app')
@section('site.title')
@endsection
@section('site.css')
@endsection
@section('site.content')
    <main>

        <!-- page title area start  -->
        <section class="page-title-area">
            <div class="container large">
                <div class="page-title-area-inner section-spacing-top">
                    <div class="page-title-wrapper">
                        <h2 class="page-title fade-anim" style="color: #1040c6!important;">NACaspia</h2>
                    </div>
                </div>
            </div>
        </section>
        <!-- page title area end  -->

        <!-- about area start  -->
        <section class="about-area-details">
            <div class="container large">
                <div class="about-area-details-inner">
                    <div class="section-header fade-anim">
                        <div class="section-title-wrapper">
                            <div class="subtitle-wrapper">
                                <span class="section-subtitle">Biz kimik?</span>
                            </div>
                            <div class="title-wrapper">
                                <h2 class="section-title font-sequelsans-romanbody">NACaspia İnformasiya Texnologiya Şirkəti</h2>
                            </div>
                        </div>
                    </div>
                    <div class="section-content-wrapper fade-anim">
                        <div class="info-list">
                            <ul>
                                <li>7 / 24 xidmət</li>
                                <li>Daimi suport</li>
                                <li>Komanda birliyi</li>
                                <li>Sürətli cavab müddəti</li>
                                <li>Peşəkar müştəri xidməti</li>
                                <li>Yüksək təhlükəsizlik standartları</li>
                                <li>Uyğun qiymət siyasəti</li>
                                <li>İstifadəçi dostu interfeys</li>
                                <li>Çevik həllər</li>
                            </ul>
                        </div>
                        <div class="section-content">
                            <div class="text-wrapper" data-direction="right">
                                <p class="text">Sizin rəqəmsal tərəfdaşınız. Biz proqram təminatlarının hazırlanması, sistem
                                    inteqrasiyası və texnoloji konsaltinq üzrə ixtisaslaşmış IT şirkətiyik.
                                </p>
                                <p class="text">Startaplardan tutmuş
                                    korporativ müştərilərə qədər – hər kəsə uyğun çevik və innovativ həllər təqdim edirik.
                                </p>
                            </div>
                            <div class="btn-wrapper" data-direction="right">
                                <a href="{{ route('site.contact') }}" class="rr-btn">
                                  <span class="btn-wrap">
                                    <span class="text-one">Bizə qoşulun</span>
                                    <span class="text-two">Bizə qoşulun</span>
                                  </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about area end  -->

        <!-- approach area start  -->
        <section class="approach-area-about-page">
            <div class="container large">
                <div class="approach-area-about-page-inner section-spacing">
                </div>
            </div>
        </section>
        <!-- approach area end  -->

        <!-- info area start  -->
        <section class="info-area-page-about">
            <div class="container large">
                <div class="info-area-page-about-inner section-spacing-top">

                    <div class="section-header fade-anim">
                        <div class="section-title-wrapper">
                            <div class="subtitle-wrapper">
                                <span class="section-subtitle">Bizim statiskamız</span>
                            </div>
                            <div class="title-wrapper">
                                <h2 class="section-title font-sequelsans-romanbody">İdeanız var və bizimlə əlaqə saxlayın.</h2>
                            </div>
                        </div>
                    </div>
                    <div class="counter-wrapper-box fade-anim">
                        <div class="counter-wrapper">
                            <div class="funfact-item">
                                <p class="text">Lahiyələr</p>
                                <h3 class="number t-counter">100 +</h3>
                            </div>
                            <div class="funfact-item">
                                <p class="text">Təcrübə</p>
                                <h3 class="number t-counter">5+ il</h3>
                            </div>
                            <div class="funfact-item">
                                <p class="text">Mükafat</p>
                                <h3 class="number t-counter">10+</h3>
                            </div>
                            <div class="funfact-item">
                                <p class="text">Müştəri</p>
                                <h3 class="number t-counter">100+</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- info area end  -->

        <!-- client area start  -->
        <div class="client-area-page-about">
            <div class="client-area-page-about-inner section-spacing">
                {{--<div class="container large">
                    <div class="section-header fade-anim">
                        <div class="text-wrapper">
                            <p class="text">Onlar bizi seçdilər</p>
                        </div>
                    </div>
                </div>
                <div class="clients-wrapper-box fade-anim">
                    <div class="clients-wrapper">
                        <div class="swiper client-slider-active">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="client-box">
                                        <img src="{{ asset('site/assets/imgs/client/client-1.webp') }}" alt="image">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="client-box">
                                        <img src="{{ asset('site/assets/imgs/client/client-1.webp') }}" alt="image">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="client-box">
                                        <img src="{{ asset('site/assets/imgs/client/client-1.webp') }}" alt="image">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="client-box">
                                        <img src="{{ asset('site/assets/imgs/client/client-1.webp') }}" alt="image">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="client-box">
                                        <img src="{{ asset('site/assets/imgs/client/client-1.webp') }}" alt="image">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="client-box">
                                        <img src="{{ asset('site/assets/imgs/client/client-1.webp') }}" alt="image">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="client-box">
                                        <img src="{{ asset('site/assets/imgs/client/client-1.webp') }}" alt="image">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="client-box">
                                        <img src="{{ asset('site/assets/imgs/client/client-1.webp') }}" alt="image">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="client-box">
                                        <img src="{{ asset('site/assets/imgs/client/client-1.webp') }}" alt="image">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="client-box">
                                        <img src="{{ asset('site/assets/imgs/client/client-1.webp') }}" alt="image">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="client-box">
                                        <img src="{{ asset('site/assets/imgs/client/client-1.webp') }}" alt="image">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="client-box">
                                        <img src="{{ asset('site/assets/imgs/client/client-1.webp') }}" alt="image">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="client-box">
                                        <img src="{{ asset('site/assets/imgs/client/client-1.webp') }}" alt="image">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="client-box">
                                        <img src="{{ asset('site/assets/imgs/client/client-1.webp') }}" alt="image">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="client-box">
                                        <img src="{{ asset('site/assets/imgs/client/client-1.webp') }}" alt="image">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="client-box">
                                        <img src="{{ asset('site/assets/imgs/client/client-1.webp') }}" alt="image">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>--}}
            </div>
        </div>
        <!-- client area end  -->

        {{--<!-- media area start  -->
        <section class="media-area-page-about">
            <div class="container large">
                <div class="media-area-page-about-inner">
                    <div class="section-content-wrapper fade-anim">
                        <div class="area-thumb parallax-view">
                            <img src="assets/imgs/gallery/image-23.html" alt="image" data-speed="0.8">
                        </div>
                        <div class="section-content">
                            <div class="section-title-wrapper">
                                <div class="title-wrapper">
                                    <h2 class="section-title font-sequelsans-romanbody">Collaborate with a super
                                        down-to-earth, mad-talented team</h2>
                                </div>
                            </div>
                            <div class="text-wrapper">
                                <p class="text">A collective bunch working on incredible projects and building enduring
                                    partnerships that extend well beyond the deliverable.</p>
                            </div>
                            <div class="btn-wrapper">
                                <a href="contact.html" class="rr-btn">
                      <span class="btn-wrap">
                        <span class="text-one">Learn More</span>
                        <span class="text-two">Learn More</span>
                      </span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- media area end  -->

        <!-- award area start  -->
        <section class="award-area-page-about">
            <div class="container large">
                <div class="award-area-page-about-inner section-spacing">
                    <div class="section-header fade-anim">
                        <div class="section-title-wrapper">
                            <div class="subtitle-wrapper">
                                <span class="section-subtitle">Awards</span>
                            </div>
                            <div class="title-wrapper" data-direction="left">
                                <h2 class="section-title font-sequelsans-romanbody">We believe in quality, not
                                    quantity, that’s why we’re
                                    great ever.</h2>
                            </div>
                        </div>
                    </div>
                    <div class="awards-wrapper-box fade-anim">
                        <div class="awards-wrapper">
                            <div class="award-box">
                                <div class="category">Awwwards</div>
                                <ul class="award-list">
                                    <li>7x Honorable Mention<span>2014</span></li>
                                    <li>4x Site of the Day<span>2016</span></li>
                                    <li>2x Developer Awards<span>2016</span></li>
                                    <li>1x Site of the Year<span>2019</span></li>
                                    <li>1x Design of the Year<span>2025</span></li>
                                </ul>
                            </div>
                            <div class="award-box">
                                <div class="category">CSS Design</div>
                                <ul class="award-list">
                                    <li>2x Website of the Day<span>2014</span></li>
                                    <li>1x Best Innovation<span>2016</span></li>
                                    <li>5x UX Design<span>2016</span></li>
                                    <li>6x Creative Design<span>2019</span></li>
                                </ul>
                            </div>
                            <div class="award-box">
                                <div class="category">Dribbble</div>
                                <ul class="award-list">
                                    <li>2x Design of the Day<span>2014</span></li>
                                    <li>2x Site of the Day<span>2016</span></li>
                                </ul>
                            </div>
                            <div class="award-box">
                                <div class="category">Behance</div>
                                <ul class="award-list">
                                    <li>5x Featured Design<span>2025</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- award area end  -->

        <!-- team area start  -->
        <section class="team-area-about-page">
            <div class="container large">
                <div class="team-area-about-page-inner section-spacing-top">
                    <div class="section-header fade-anim">
                        <div class="section-title-wrapper">
                            <div class="subtitle-wrapper">
                                <span class="section-subtitle">Team</span>
                            </div>
                            <div class="title-wrapper">
                                <h2 class="section-title font-sequelsans-romanbody">Meet the talented
                                    squad, behind the
                                    creativity</h2>
                            </div>
                        </div>
                    </div>
                    <div class="team-wrapper-box fade-anim">
                        <div class="team-wrapper">
                            <div class="team-box">
                                <div class="thumb">
                                    <a href="team-details.html"><img src="assets/imgs/team/team-1.webp" alt="image"></a>
                                </div>
                                <div class="content">
                                    <h3 class="name"><a href="team-details.html">James David</a></h3>
                                    <span class="post">CEO & Founder</span>
                                </div>
                            </div>
                            <div class="team-box">
                                <div class="thumb">
                                    <a href="team-details.html"><img src="assets/imgs/team/team-2.webp" alt="image"></a>
                                </div>
                                <div class="content">
                                    <h3 class="name"><a href="team-details.html">Brenda C. Janet</a></h3>
                                    <span class="post">Lead Developer</span>
                                </div>
                            </div>
                            <div class="team-box">
                                <div class="thumb">
                                    <a href="team-details.html"><img src="assets/imgs/team/team-3.html" alt="image"></a>
                                </div>
                                <div class="content">
                                    <h3 class="name"><a href="team-details.html">Martin Carlos</a></h3>
                                    <span class="post">Lead Designer</span>
                                </div>
                            </div>
                            <div class="team-box">
                                <div class="thumb">
                                    <a href="team-details.html"><img src="assets/imgs/team/team-4.webp" alt="image"></a>
                                </div>
                                <div class="content">
                                    <h3 class="name"><a href="team-details.html">Garry J. Coburn</a></h3>
                                    <span class="post">Project Manager</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- team area end  -->

        <!-- team list area start  -->
        <div class="team-list-area">
            <div class="container large">
                <div class="team-list-area-inner">
                    <div class="team-wrapper-box fade-anim">
                        <div class="team-wrapper">
                            <div class="team-box">
                                <div class="thumb">
                                    <a href="team-details.html"><img src="assets/imgs/team/team-5.html" alt="image"></a>
                                </div>
                                <div class="content">
                                    <h3 class="name"><a href="team-details.html">Ana Dina Belić</a></h3>
                                </div>
                                <span class="post">Graphic Designer</span>
                                <a href="team-details.html" class="t-btn t-btn-normal"><img src="assets/imgs/icon/icon-5.webp"
                                                                                            alt="image"></a>
                            </div>
                            <div class="team-box">
                                <div class="thumb">
                                    <a href="team-details.html"><img src="assets/imgs/team/team-6.html" alt="image"></a>
                                </div>
                                <div class="content">
                                    <h3 class="name"><a href="team-details.html">Giuseppe Carbonara</a></h3>
                                </div>
                                <span class="post">Brand Strategist</span>
                                <a href="team-details.html" class="t-btn t-btn-normal"><img src="assets/imgs/icon/icon-5.webp"
                                                                                            alt="image"></a>
                            </div>
                            <div class="team-box">
                                <div class="thumb">
                                    <a href="team-details.html"><img src="assets/imgs/team/team-7.html" alt="image"></a>
                                </div>
                                <div class="content">
                                    <h3 class="name"><a href="team-details.html">Vedran Starčić</a></h3>
                                </div>
                                <span class="post">Jr. Designer</span>
                                <a href="team-details.html" class="t-btn t-btn-normal"><img src="assets/imgs/icon/icon-5.webp"
                                                                                            alt="image"></a>
                            </div>
                            <div class="team-box">
                                <div class="thumb">
                                    <a href="team-details.html"><img src="assets/imgs/team/team-8.html" alt="image"></a>
                                </div>
                                <div class="content">
                                    <h3 class="name"><a href="team-details.html">Izquierdo Bayà</a></h3>
                                </div>
                                <span class="post">Creative Writer </span>
                                <a href="team-details.html" class="t-btn t-btn-normal"><img src="assets/imgs/icon/icon-5.webp"
                                                                                            alt="image"></a>
                            </div>
                            <div class="team-box">
                                <div class="thumb">
                                    <a href="team-details.html"><img src="assets/imgs/team/team-9.html" alt="image"></a>
                                </div>
                                <div class="content">
                                    <h3 class="name"><a href="team-details.html">Jared Silverman</a></h3>
                                </div>
                                <span class="post">Motion Designer</span>
                                <a href="team-details.html" class="t-btn t-btn-normal"><img src="assets/imgs/icon/icon-5.webp"
                                                                                            alt="image"></a>
                            </div>
                            <div class="team-box">
                                <div class="thumb">
                                    <a href="team-details.html"><img src="assets/imgs/team/team-10.html" alt="image"></a>
                                </div>
                                <div class="content">
                                    <h3 class="name"><a href="team-details.html">Samuel Bertain</a></h3>
                                </div>
                                <span class="post">WordPress Developer</span>
                                <a href="team-details.html" class="t-btn t-btn-normal"><img src="assets/imgs/icon/icon-5.webp"
                                                                                            alt="image"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- team list area end  -->--}}

    </main>
@endsection
@section('site.js')
@endsection
