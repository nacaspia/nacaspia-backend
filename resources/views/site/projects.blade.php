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
                        <h2 >Lahiyələrimiz</h2>
                    </div>
                </div>
            </div>
        </section>
        <!-- page title area end  -->

        <!-- work area start  -->
        <section class="work-area-work-page">
            <div class="work-area-work-page-inner">
                <div class="container large">
                    <div class="section-header fade-anim">
                        <div class="section-title-wrapper">
{{--                            <div class="subtitle-wrapper">--}}
{{--                                <span class="section-subtitle">Recent work</span>--}}
{{--                            </div>--}}
{{--                            <div class="title-wrapper">--}}
{{--                                <h2 class="section-title font-sequelsans-romanbody">Creative works--}}
{{--                                    with our incredible--}}
{{--                                    people.</h2>--}}
{{--                            </div>--}}
                        </div>
                    </div>

                </div>
                <div class="works-wrapper-box">
                    <div class="container large">
                        <div class="works-wrapper-8">

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
                            <div class="work-box">
                                <div class="thumb">
                                    <div class="image scale" data-cursor-text="Yenilik axtar" data-cursor-text-red>
                                        <a href="https://innovamed.ge/" target="_blank"><img src="{{ asset('site/assets/imgs/project/innovamed.png') }}" alt="image"></a>
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
                                        <a href="https://topnotch.az/" target="_blank"><img src="{{ asset('site/assets/imgs/project/topnotch.png') }}" alt="image"></a>
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
                                        <a href="https://mrfix.az/" target="_blank"><img src="{{ asset('site/assets/imgs/project/mrfix.png') }}" alt="image"></a>
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
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- work area end  -->

    </main>
@endsection
@section('site.js')
@endsection
