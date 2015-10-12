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
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div class="container" style="padding-top:0">
        <div class="page-title" style="background-color: #fdd204; width: 100%; margin:0; height:130px; line-height: 130px; font-size: 5.5em; font-weight:600; text-align: right; padding-right: 15px; color: #231f20; margin-bottom: 30px">
            INDIVIDUALS OR GROUPS
        </div>
        <div class="content" style="margin: 0 15px">
            <div class="row">
                <div class="col-md-3 col-xs-12 pull-right">
                    {{--  Form Input--}}
                    <div class="form-group">
                        {!! Form::select("groups",["group1", "group2"],null,["class"=>"form-control"]) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-xs-6">
                    <img src="http://lorempixel.com/400/300/" class="img-responsive" alt="" />
                    <p class="description">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda dolore eius facilis illo labore nemo pariatur quis tenetur voluptate voluptatem!
                    </p>
                </div>
                <div class="col-md-4 col-xs-6">
                    <img src="http://lorempixel.com/400/300/" class="img-responsive" alt="" />
                    <p class="description">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda dolore eius facilis illo labore nemo pariatur quis tenetur voluptate voluptatem!
                    </p>
                </div>
                <div class="col-md-4 col-xs-6">
                    <img src="http://lorempixel.com/400/300/" class="img-responsive" alt="" />
                    <p class="description">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda dolore eius facilis illo labore nemo pariatur quis tenetur voluptate voluptatem!
                    </p>
                </div>
                <div class="col-md-4 col-xs-6">
                    <img src="http://lorempixel.com/400/300/" class="img-responsive" alt="" />
                    <p class="description">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda dolore eius facilis illo labore nemo pariatur quis tenetur voluptate voluptatem!
                    </p>
                </div>
                <div class="col-md-4 col-xs-6">
                    <img src="http://lorempixel.com/400/300/" class="img-responsive" alt="" />
                    <p class="description">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda dolore eius facilis illo labore nemo pariatur quis tenetur voluptate voluptatem!
                    </p>
                </div>
                <div class="col-md-4 col-xs-6">
                    <img src="http://lorempixel.com/400/300/" class="img-responsive" alt="" />
                    <p class="description">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda dolore eius facilis illo labore nemo pariatur quis tenetur voluptate voluptatem!
                    </p>
                </div>
                <div class="col-md-4 col-xs-6">
                    <img src="http://lorempixel.com/400/300/" class="img-responsive" alt="" />
                    <p class="description">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda dolore eius facilis illo labore nemo pariatur quis tenetur voluptate voluptatem!
                    </p>
                </div>
                <div class="col-md-4 col-xs-6">
                    <img src="http://lorempixel.com/400/300/" class="img-responsive" alt="" />
                    <p class="description">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda dolore eius facilis illo labore nemo pariatur quis tenetur voluptate voluptatem!
                    </p>
                </div>
                <div class="col-md-4 col-xs-6">
                    <img src="http://lorempixel.com/400/300/" class="img-responsive" alt="" />
                    <p class="description">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda dolore eius facilis illo labore nemo pariatur quis tenetur voluptate voluptatem!
                    </p>
                </div>
                <div class="col-md-4 col-xs-6">
                    <img src="http://lorempixel.com/400/300/" class="img-responsive" alt="" />
                    <p class="description">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda dolore eius facilis illo labore nemo pariatur quis tenetur voluptate voluptatem!
                    </p>
                </div>
                <div class="col-md-4 col-xs-6">
                    <img src="http://lorempixel.com/400/300/" class="img-responsive" alt="" />
                    <p class="description">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda dolore eius facilis illo labore nemo pariatur quis tenetur voluptate voluptatem!
                    </p>
                </div>
                <div class="col-md-4 col-xs-6">
                    <img src="http://lorempixel.com/400/300/" class="img-responsive" alt="" />
                    <p class="description">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda dolore eius facilis illo labore nemo pariatur quis tenetur voluptate voluptatem!
                    </p>
                </div>
                <div class="col-md-4 col-xs-6">
                    <img src="http://lorempixel.com/400/300/" class="img-responsive" alt="" />
                    <p class="description">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda dolore eius facilis illo labore nemo pariatur quis tenetur voluptate voluptatem!
                    </p>
                </div>
                <div class="col-md-4 col-xs-6">
                    <img src="http://lorempixel.com/400/300/" class="img-responsive" alt="" />
                    <p class="description">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda dolore eius facilis illo labore nemo pariatur quis tenetur voluptate voluptatem!
                    </p>
                </div>
                <div class="col-md-4 col-xs-6">
                    <img src="http://lorempixel.com/400/300/" class="img-responsive" alt="" />
                    <p class="description">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda dolore eius facilis illo labore nemo pariatur quis tenetur voluptate voluptatem!
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection