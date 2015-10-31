@inject('object', 'App\Services\Content')
<?php
    $object->setTable('layout_articles');
        $articles = $object->whereWriterIdentifier($content->content_identifier)->whereActive(1)->get();
?>
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
        .writer_description{
            padding: 15px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="hero_container clearfix">
            <img src="{{$content->pic}}" width="100%"alt="" />
        </div>
        <div class="writer_description">
            {!!  $content->intro !!}
        </div>
    </div>
    <div class="container">
        @if(count($articles)>0)
            <div class="grid">
                <div class="grid-sizer"></div>
                @foreach($articles as $article)
                    <div class="grid-item">
                        <img src="{{$article->image1}}" />
                        <div class="text-center block-description">
                            {{$article->summary}}
                            <br />
                            <a href="/articles/{{$article->content_identifier}}" class="text-center">More</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

@endsection

@section('scripts')
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
