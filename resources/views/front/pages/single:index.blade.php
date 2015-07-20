@extends('front.layouts.default')

@section('meta')
    <meta name="description" content="Events">
    <meta name="keywords" content="Hong Kongs,Events,July">
    <meta name="author" content="Xavier Au">
@endsection

@section('stylesheets')
    <link rel="stylesheet" href="/front/css/month.css" />
@endsection

@section('title') Events @endsection

@section('content')
    {{-- The contain the carosuel --}}
    <div class="container-fluid" id="UpperCarousel">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                <li data-target="#carousel-example-generic" data-slide-to="3"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="http://lorempixel.com/900/500/animals/" width="100%" alt="...">
                    <div class="carousel-caption">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium culpa delectus deserunt dolore exercitationem quae vero, voluptatem! Eaque, in qui.
                        <a href="/events/detail" style="bottom:5%; right:75%; position:absolute">MORE <i class="fa fa-chevron-right"></i></a>
                    </div>
                </div>
                <div class="item ">
                    <img src="http://lorempixel.com/900/500/city/" width="100%" alt="...">
                    <div class="carousel-caption">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium culpa delectus deserunt dolore exercitationem quae vero, voluptatem! Eaque, in qui.
                        <a href="/events/detail" style="bottom:5%; right:75%; position:absolute">MORE <i class="fa fa-chevron-right"></i></a>
                    </div>
                </div>
                <div class="item ">
                    <img src="http://lorempixel.com/900/500/sports/" width="100%" alt="...">
                    <div class="carousel-caption">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium culpa delectus deserunt dolore exercitationem quae vero, voluptatem! Eaque, in qui.
                        <a href="/events/detail" style="bottom:5%; right:75%; position:absolute">MORE <i class="fa fa-chevron-right"></i></a>
                    </div>
                </div>
                <div class="item ">
                    <img src="http://lorempixel.com/900/500/nature/" width="100%" alt="...">
                    <div class="carousel-caption">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium culpa delectus deserunt dolore exercitationem quae vero, voluptatem! Eaque, in qui.
                        <a href="/events/detail" style="bottom:5%; right:75%; position:absolute">MORE <i class="fa fa-chevron-right"></i></a>
                    </div>
                </div>

            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    {{-- Contain event blocks --}}
    <div class="container" id="vue">
        <div class="page-title" >
            <div class="control_button left" v-on="click: changeMonth(-1)"><i class="fa fa-chevron-left"></i></div>
            <div class="control_button right" v-on="click: changeMonth(+1)"><i class="fa fa-chevron-right"></i></div>
            @{{ currentMonth }}
        </div>

        {{--The following is the events block move right--}}
        <div class="col-md-4 col-xs-6 carouselContainer" v-repeat="blocks">
            <div id="date-@{{ $index }}" class="carousel slide blocks @{{ class }} " data-interval="false" data-ride="carousel">
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div v-class="item:true, active: $index==0" v-repeat="events">
                        <div class="col-xs-7 imgContainer">
                            <img src="@{{ image }}" width="100%" alt="Chania">
                        </div>
                        <div class="col-xs-5 carousel-caption">
                            <p>@{{ description }}</p>
                            <a href="/events/detail/@{{ id }}" class="link_detail">More <i class="fa fa-chevron-right"></i></a>
                        </div>
                    </div>
                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#date-@{{ $index }}" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#date-@{{ $index }}" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="/js/monthBundle.js"></script>
@endsection