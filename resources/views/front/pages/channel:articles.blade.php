
@inject("content", "")
@extends('front.layouts.default')

@section('meta')
    <meta name="description" content="Events">
    <meta name="keywords" content="Hong Kongs,Events,July">
    <meta name="author" content="Xavier Au">
@endsection

@section('stylesheets')
    <style>
        .details{
            margin-bottom: 2em;
        }
        .social_link{
            margin-bottom: 2em;
        }
        .links{
            margin-bottom: 2em;
        }
        /* Carousel */
        .container.carousel{
            padding: 0;
            margin-bottom: 2em;
        }
        .carousel-indicators{
            text-align: right;
            bottom:0;
            position:absolute;
            margin:0;
            left:auto;
            right:3%;
            font-size: 4em;
            line-height: 80px;
        }
        .carousel-indicators li, .carousel-indicators li.active{
            height:18px;
            width: 18px;
            border-color:rgb(253,210,4) ;
        }
        .carousel-indicators li.active{
            background-color:rgb(253,210,4);

        }
        .carousel-caption{
            font-size: 1.3em;
            background:blue;
            position:absolute;
            right:0;
            min-height: 100%;
            padding: 20px;
            margin: 0;
            bottom:0;
            width: 30%;
            left:auto;
        }
        .carousel-caption a{
            color:white;
        }

        a.writer_profile{
            display: block;
            text-align: center;
        }
        .writer_description{
            text-align: center;
        }



    </style>
@endsection

@section('title') Events @endsection

@section('content')
    {{-- The contain the carosuel --}}
    <div class="container carousel">
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
                </div>
                <div class="item ">
                    <img src="http://lorempixel.com/900/500/city/" width="100%" alt="...">
                </div>
                <div class="item ">
                    <img src="http://lorempixel.com/900/500/sports/" width="100%" alt="...">
                </div>
                <div class="item ">
                    <img src="http://lorempixel.com/900/500/nature/" width="100%" alt="...">
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
    <div class="container" style="padding-top:0" id="vue">
        <div class="col-md-9">
            <div class="info" layout-content="info" content-type="text">
                {{$content->info}}
            </div>
            <div class="details" layout-content="details" content-type="text">
                {{$content->details}}
            </div>
            <div class="social_link">
                <ul class="list-inline">
                    <li><i class="fa fa-2x fa-facebook-square"></i></li>
                    <li><i class="fa fa-2x fa-twitter-square"></i></li>
                    <li><i class="fa fa-2x fa-envelope-o"></i></li>
                    <li><i class="fa fa-2x fa-google-plus-square"></i></li>
                    <li><i class="fa fa-2x fa-instagram"></i></li>
                </ul>
            </div>

            <div class="links visible-md visible-lg clearfix">
                <a href="#" class="pull-left">Previous</a>
                <a href="#" class="pull-right">Next</a>
            </div>

            <div class="hidden-xs hidden-sm">
                <div class="row">
                    <div class="col-md-3">testing1</div>
                    <div class="col-md-3">testing2</div>
                    <div class="col-md-3">testing3</div>
                    <div class="col-md-3">testing4</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <img class="img-responsive" src="http://lorempixel.com/600/500/people/" alt="" />
            <div class="writer_description" layout-content="writer_description" content-type="text">
                {{$content->writer_description}}
            </div>
            <a href="/writer/{{$content->id}}" class="writer_profile">MORE</a>
        </div>
    </div>

@endsection
