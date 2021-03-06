@extends('front.layouts.default')

@section('meta')
    <meta name="description" content="Free Web tutorials">
    <meta name="keywords" content="HTML,CSS,XML,JavaScript">
    <meta name="author" content="Hege Refsnes">
@endsection

@section('title') Groups @endsection

@section("stylesheets")
    <style>
        p.description{
            margin-top: 10px;
            text-align: center;
        }
        .blocks{
            margin-bottom: 20px;
        }
        .blocks a{
            display: block;
            color: black;
            font-weight: 600;
            text-align: center;
        }
        .main_image{
            margin-left: 15px;
            margin-right: 15px;
            margin-bottom:20px;
        }
    </style>
@endsection

@section('content')
    <div class="container" style="padding-top:0">
        <div class="main_image">
            <img src="{{$contents->first()->pic}}" class="img-responsive" alt="" />
        </div>
        <div class="content" style="margin: 0 15px">
            <div class="row">
                @foreach($contents as $content)
                    <div class="col-md-4 col-xs-6 blocks">
                        <img src="{{$content->thumbnail}}" class="img-responsive center-block" alt="" />
                        <p class="description">
                            {{$content->summary}}
                        </p>
                        <a href="writers/{{$content->content_identifier}}">VIEW MORE</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection