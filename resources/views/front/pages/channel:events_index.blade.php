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

    {{-- Contain event blocks --}}
    <div class="container" id="vue">
        <div class="page-title" >
            <div class="control_button left" v-on="click: changeMonth(-1)"><i class="fa fa-chevron-left"></i></div>
            <div class="control_button right" v-on="click: changeMonth(+1)"><i class="fa fa-chevron-right"></i></div>
            @{{ currentMonth }}
        </div>
        <div class="row" id="catSelector">
            <div class="col-xs-12 col-md-3 pull-right">
                {{--  Form Input--}}
                <div class="form-group">
                    {!! Form::select("category",["Dance","Martial Art"],null,["class"=>"form-control"]) !!}
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xs-6" id="displayMonth">
            <p id="currentMonth"></p>
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
    <script>

        // parse query string form url
        var url = window.location.href;
        var queryPair = url.split("?")[1].split('&');
        var queryString = {};
        for(var i = 0; i < queryPair.length; i++){
            queryString[queryPair[i].split("=")[0]] = queryPair[i].split("=")[1];
        }

        // set page title
        $(".page-title").text(queryString.cat.toUpperCase());

        // set date
        var date;
        queryString.hasOwnProperty("date")? date = moment(queryString.date, "YYYYMM").format("MMMM"): date = moment().format("MMMM");
        $("#currentMonth").text(date.toUpperCase());
    </script>
@endsection