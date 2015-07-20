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
            <div class="info">
                <h5>this is the suject of the event</h5>
                <h5>Here is the time</h5>
                <h5>and address</h5>
            </div>
            <div class="details">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda beatae consequuntur deleniti dicta dolorem doloremque et eum excepturi fugiat harum in ipsam maiores mollitia necessitatibus, nesciunt obcaecati odit praesentium quis quos rem temporibus ut vero! Aliquid dignissimos non quasi saepe? At, enim, incidunt libero maiores nobis officiis optio provident quae quas, quidem quo rem reprehenderit sunt velit voluptas voluptatem voluptates. Animi at consequuntur, cumque deserunt est expedita explicabo harum ipsum iure nihil perferendis quaerat quisquam repudiandae sunt ut! Alias fugit nemo possimus quae, ratione unde? Accusamus aspernatur assumenda cum cupiditate delectus doloribus dolorum ex exercitationem explicabo facere laboriosam laborum mollitia, nesciunt nobis, officiis praesentium quas quos reiciendis repellat, totam ut velit voluptas! Cupiditate, dolor est natus quas reprehenderit rerum. Adipisci architecto aut blanditiis corporis deleniti eaque eius error eum ex expedita facere facilis, fugit inventore minus molestias odio placeat praesentium provident quam, quia quo ratione rem rerum sequi, tempore ullam voluptatem voluptatum. A ab ad aliquid aperiam at commodi corporis dicta dignissimos dolore doloremque error est eveniet exercitationem fuga fugiat id iure iusto laboriosam maiores molestiae nesciunt odio omnis quas qui, quibusdam ratione, rem repellat repudiandae rerum unde vel velit voluptate voluptatibus? Ab animi consequatur deserunt itaque sunt unde voluptatem!
                </p>
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
            <div class="writer_description">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa cum distinctio illum, magnam minus nam nostrum omnis reiciendis tempora! Accusamus assumenda, dolores eligendi expedita facere id quis. Consequatur, odit, repellat?
            </div>
            <a href="/writer/1" class="writer_profile">MORE</a>
        </div>
    </div>

@endsection
