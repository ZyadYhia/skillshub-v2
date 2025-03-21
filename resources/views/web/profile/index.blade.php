@extends('web.layout')
@section('title')
    Profile
@endsection
@section('main')
    <!-- Hero-area -->
    <div class="hero-area section">

        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay"
            style="background-image:url({{ asset('web/img/page-background.jpg') }})">
        </div>
        <!-- /Backgound Image -->

        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <ul class="hero-area-tree">
                        <li><a href="{{ url('') }}">{{ __('web.home') }}</a></li>
                        <li>{{ __('web.profile') }}</li>
                    </ul>
                    <h1 class="white-text">{{ __('web.profile') }}</h1>

                </div>
            </div>
        </div>

    </div>
    <!-- /Hero-area -->

    <!-- Contact -->
    <div id="contact" class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <!-- login form -->
                <div class="col-md-6 col-md-offset-3">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Exam name:</th>
                                <th>Score</th>
                                <th>Time (mins):</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Auth::user()->exams as $exam)
                                <tr>
                                    <th>{{$exam->name()}}</th>
                                    <th>{{$exam->pivot->score}}</th>
                                    <th>{{$exam->pivot->time_mins}}</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /login form -->

            </div>
            <!-- /row -->

        </div>
        <!-- /container -->

    </div>
    <!-- /Contact -->
@endsection
