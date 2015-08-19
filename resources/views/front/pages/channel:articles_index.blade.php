@extends('front.layouts.default')

@section('stylesheets')
    <style>
        .hero_container{
            position:relative;
        }

        .description{
            background-color: rgba(0,0,0,0.5);
            color:white;
            position:absolute;
            bottom:0;
            margin-left:auto;
            margin-right:auto;
            left:0;
            right:0;
            padding: 10px;
        }
        .hero_container .description{
            width: 30%;
        }

        .block_container .description{
            position:relative;
            width: 90%;
            background-color: transparent;
            color:#000000;
        }
        /* ---- isotope ---- */

        .grid {
            /*background: #DDD;*/
        }

        /* clear fix */
        .grid:after {
            content: '';
            display: block;
            clear: both;
        }

        /* ---- .grid-item ---- */

        .grid-sizer,
        .grid-item {
            width: 32.47%;
            margin:5px;
            margin-bottom: 15px;
        }

        .grid-item {
            float: left;
            margin:5px;
            margin-bottom: 15px;
        }

        .grid-item img {
            display: block;
            max-width: 100%;
        }
        .block-description{
            width: 50%;
            margin-right: auto;
            margin-left: auto;
        }
    </style>
@endsection

@section('content')
    <div class="container" id="vue">
        <div class="hero_container clearfix">
            <img src="http://lorempixel.com/800/350/sports" width="100%"alt="" />
            <div class="description text-center">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. A accusantium consequatur, explicabo facere iure nobis quas sequi suscipit veniam voluptates?
                <br />
                <a href="#">MORE</a>
            </div>
        </div>

    </div>
    <div class="container">
        <div class="grid">
            <div class="grid-sizer"></div>
            <div class="grid-item">
                <img src="http://i.imgur.com/bwy74ok.jpg" />
                <div class="text-center block-description">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse, porro.
                    <br />
                    <a href="#" class="text-center">More</a>
                </div>
            </div>
            <div class="grid-item">
                <img src="http://i.imgur.com/bAZWoqx.jpg" />
                <div class="text-center block-description">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse, porro.
                    <br />
                    <a href="#" class="text-center">More</a>
                </div>
            </div>
            <div class="grid-item">
                <img src="http://i.imgur.com/PgmEBSB.jpg" />
                <div class="text-center block-description">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse, porro.
                    <br />
                    <a href="#" class="text-center">More</a>
                </div>
            </div>
            <div class="grid-item">
                <img src="http://i.imgur.com/aboaFoB.jpg" />
                <div class="text-center block-description">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse, porro.
                    <br />
                    <a href="#" class="text-center">More</a>
                </div>
            </div>
            <div class="grid-item">
                <img src="http://i.imgur.com/LkmcILl.jpg" />
                <div class="text-center block-description">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse, porro.
                    <br />
                    <a href="#" class="text-center">More</a>
                </div>
            </div>
            <div class="grid-item">
                <img src="http://i.imgur.com/q9zO6tw.jpg" />
                <div class="text-center block-description">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse, porro.
                    <br />
                    <a href="#" class="text-center">More</a>
                </div>
            </div>
            <div class="grid-item">
                <img src="http://i.imgur.com/r8p3Xgq.jpg" />
                <div class="text-center block-description">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse, porro.
                    <br />
                    <a href="#" class="text-center">More</a>
                </div>
            </div>
            <div class="grid-item">
                <img src="http://i.imgur.com/hODreXI.jpg" />
                <div class="text-center block-description">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse, porro.
                    <br />
                    <a href="#" class="text-center">More</a>
                </div>
            </div>
            <div class="grid-item">
                <img src="http://i.imgur.com/UORFJ3w.jpg" />
                <div class="text-center block-description">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse, porro.
                    <br />
                    <a href="#" class="text-center">More</a>
                </div>
            </div>
        </div>


    </div>

@endsection

@section('scripts')
    <script>
        var articlesvue = new Vue({
            el: "#vue",
            ready:function(){
                console.log("vue ready")
            }
        })
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.1/masonry.pkgd.min.js"></script>
    <script src="http://imagesloaded.desandro.com/imagesloaded.pkgd.min.js"></script>
    <script>
        var $grid = $('.grid').masonry({
            // options
            itemSelector: '.grid-item',
            columnWidth: '.grid-sizer',
            percentPosition: true
        });
        $grid.imagesLoaded().progress( function() {
            $grid.masonry('layout');
        });
    </script>
@endsection
