@extends('site.layouts.app')
@section('site.title')
@endsection
@section('site.css')
@endsection
@section('site.content')
    <!-- Start Service Details Page Banner Area -->
    <div class="service-details-page-banner-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="content position-relative">
                        <h1 class="text-animation">
                            Brand <span>strategy</span>
                        </h1>
                        <p>
                            We help define your brand’s identity and create a roadmap for consistent growth, positioning, and market presence.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="image">
                        <img src="{{ asset("site/assets/images/services/service-details.jpg") }}" alt="service-details-image">
                        <div class="info d-flex align-items-center">
                            <div class="number lh-1">
                                212<span>+</span>
                            </div>
                            <span class="d-block title">
                                    Relevant work accomplished
                                </span>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>
    <!-- End Service Details Page Banner Area -->

    <!-- Start Works Process Area -->
    <div class="works-process-area ptb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="works-process-content">
                        <h1>
                            Our workflow <span>strategy</span>
                        </h1>
                        <img src="{{ asset("site/assets/images/works-process.jpg") }}" alt="works-process-image">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="works-process-lines">
                        <div class="item position-relative">
                            <div class="number d-flex align-items-center justify-content-center text-center rounded-circle">
                                01
                            </div>
                            <div class="icon position-relative">
                                <img src="{{ asset("site/assets/images/icons/tidal.png") }}" alt="icon">
                                <img src="{{ asset("site/assets/images/icons/tidal2.svg") }}" alt="icon">
                            </div>
                            <h3>
                                Ideation phase
                            </h3>
                            <p>
                                We begin by brainstorming and refining creative ideas that align with your brand vision. This phase sets the foundation for a strategic and impactful execution.
                            </p>
                            <hr>
                        </div>
                        <div class="item position-relative">
                            <div class="number d-flex align-items-center justify-content-center text-center rounded-circle">
                                02
                            </div>
                            <div class="icon position-relative">
                                <img src="{{ asset("site/assets/images/icons/codepen.svg") }}" alt="icon">
                                <img src="{{ asset("site/assets/images/icons/codepen2.svg") }}" alt="icon">
                            </div>
                            <h3>
                                Planning & strategy
                            </h3>
                            <p>
                                A well-defined roadmap ensures smooth project execution. We focus on research, goal-setting, and structuring a clear strategy tailored to your objectives.
                            </p>
                            <hr>
                        </div>
                        <div class="item position-relative">
                            <div class="number d-flex align-items-center justify-content-center text-center rounded-circle">
                                03
                            </div>
                            <div class="icon position-relative">
                                <img src="{{ asset("site/assets/images/icons/dhis.svg") }}" alt="icon">
                                <img src="{{ asset("site/assets/images/icons/dhis2.svg") }}" alt="icon">
                            </div>
                            <h3>
                                Execution & development
                            </h3>
                            <p>
                                Bringing ideas to life with precision and creativity. Our team works on design, development, and content creation while ensuring quality and consistency.
                            </p>
                            <hr>
                        </div>
                        <div class="item position-relative">
                            <div class="number d-flex align-items-center justify-content-center text-center rounded-circle">
                                04
                            </div>
                            <div class="icon position-relative">
                                <img src="{{ asset("site/assets/images/icons/tidal.png") }}" alt="icon">
                                <img src="{{ asset("site/assets/images/icons/tidal2.svg") }}" alt="icon">
                            </div>
                            <h3>
                                Review & optimization
                            </h3>
                            <p>
                                We analyze results, gather feedback, and make refinements to enhance performance. Continuous improvement ensures long-term success and effectiveness.
                            </p>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Works Process Area -->

@endsection
@section('site.js')
@endsection
