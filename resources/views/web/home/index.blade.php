@extends('web.layout')
@section('title')
    Home Page
@endsection
@section('main')
    <!-- Home -->
    <div id="home" class="hero-area">

        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay" style="background-image:url({{ asset('web/img/home-background.jpg') }})">
        </div>
        <!-- /Backgound Image -->

        <div class="home-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h1 class="white-text">{{ __('web.head_title') }}</h1>
                        <p class="lead white-text">{{ __('web.sub_title') }}</p>
                        <a class="main-button icon-button" href="#">{{ __('web.get_started') }}</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /Home -->

    <!-- Courses -->
    <div id="courses" class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">
                <div class="section-header text-center">
                    <h2>{{ __('web.popular_exams') }}</h2>
                    <p class="lead">{{ __('web.exams_subtitle') }}</p>
                </div>
            </div>
            <!-- /row -->

            <!-- courses -->
            <div id="courses-wrapper">

                <!-- row -->
                <div class="row">
                    @foreach ($skills as $skill)
                        <!-- single course -->
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="course">
                                <a href="{{ url("skills/show/$skill->id") }}" class="course-img">
                                    <img src="{{ asset('uploads/skills/1.png') }}" alt="">
                                    <i class="course-link-icon fa fa-link"></i>
                                </a>
                                <a class="course-title" href="#">{{ $skill->name() }}</a>
                                <div class="course-details">
                                    <span class="course-category">{{ $skill->cat }}</span>
                                </div>
                            </div>
                        </div>
                        <!-- /single course -->
                    @endforeach


                </div>

            </div>
            <!-- /courses -->

            <div class="row">
                <div class="center-btn">
                    <a class="main-button icon-button" href="#">{{ __('web.more_courses') }}</a>
                </div>
            </div>

        </div>
        <!-- container -->

    </div>
    <!-- /Courses -->



    <!-- Contact CTA -->
    <div id="contact-cta" class="section">

        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay" style="background-image:url({{ asset('web/img/cta.jpg') }})"></div>
        <!-- Backgound Image -->

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <div class="col-md-8 col-md-offset-2 text-center">
                    <h2 class="white-text">{{ __('web.contact') }}</h2>
                    <p class="lead white-text">{{ __('web.contact_us_title') }}</p>
                    <a class="main-button icon-button" href="{{ url('/contact') }}">{{ __('web.contact_now') }}</a>
                </div>

            </div>
            <!-- /row -->

        </div>
        <!-- /container -->

    </div>
    <!-- /Contact CTA -->
@endsection
