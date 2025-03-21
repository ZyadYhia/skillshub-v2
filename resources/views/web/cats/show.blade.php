@extends('web.layout')
@section('title')
    categories: {{ $cat->name() }}
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
                        <li><a href="{{url('/')}}">{{ __('web.home') }}</a></li>
                        <li>{{ $cat->name() }}</li>
                    </ul>
                    <h1 class="white-text">{{ $cat->name() }}</h1>

                </div>
            </div>
        </div>

    </div>
    <!-- /Hero-area -->

    <!-- Blog -->
    <div id="blog" class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <!-- main blog -->
                <div id="main" class="col-md-9">

                    <!-- row -->
                    <div class="row">

                        @foreach ($skills as $skill)
                            <!-- single skill -->
                            <div class="col-md-4">
                                <div class="single-blog">
                                    <div class="blog-img">
                                        <a href="{{url("skills/show/$skill->id")}}">
                                            <img src="{{ asset("uploads/$skill->img") }}" alt="">
                                        </a>
                                    </div>
                                    <h4><a href="{{url("skills/show/$skill->id")}}">{{$skill->name()}}</a></h4>
                                    <div class="blog-meta">
                                        {{-- <span>18 Oct, 2017</span> --}}
                                        <span>{{ Carbon\Carbon::parse($skill->created_at)->format('d M, Y') }}</span>

                                        <div class="pull-right">
                                            <span class="blog-meta-comments"><a href="#"><i class="fa fa-users"></i>
                                                    {{ $skill->getStudentsCount() }}</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /single skill -->
                        @endforeach



                    </div>
                    <!-- /row -->

                    <!-- row -->
                    <div class="row">

                    {{ $skills->links('web.includes.paginator')}}

                    </div>
                    <!-- /row -->
                </div>
                <!-- /main blog -->

                <!-- aside blog -->
                <div id="aside" class="col-md-3">

                    <!-- search widget -->
                    <div class="widget search-widget">
                        <form>
                            <input class="input" type="text" name="search">
                            <button><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <!-- /search widget -->

                    <!-- category widget -->
                    <div class="widget category-widget">
                        <h3>Categories</h3>
                        @foreach ($all_cats as $one_cat)
                            <a class="category"
                                href="{{ url("categories/show/$one_cat->id") }}">{{ $one_cat->name() }}<span>{{ $one_cat->skills()->count() }}</span></a>
                        @endforeach
                    </div>
                    <!-- /category widget -->
                </div>
                <!-- /aside blog -->

            </div>
            <!-- row -->

        </div>
        <!-- container -->

    </div>
    <!-- /Blog -->


@endsection
