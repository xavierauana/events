@extends('front.layouts.default')

@section('meta')
    <meta name="description" content="{{$content->meta_description}}">
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


        /*Calender Style*/
        #calendar{
            background-color: darkgray;
            color:white;
            margin-bottom: 1em;
            padding-bottom: 1em;
            padding-top: 1em;
        }
        #calendar .month{
            text-align: center;
            font-weight: 400;
        }
        #calendar .days{
            margin:0 auto;
        }
        #calendar .days .day{
            display:inline-block;
            padding: 0;
            margin:0;
            margin-top:3px;
            margin-bottom:3px;
            width:12.5%;
            text-align: center;
            height:22px;
        }
        #calendar .days .event{
            background-image: url("http://4vector.com/i/free-vector-circle-clip-art_107990_Circle_clip_art_hight.png");
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center center;
        }
        #calendar .days .adjacent-month{
            color: transparent;
        }


    </style>
@endsection

@section('title') {{$content->meta_title}} @endsection

@section('content')
    {{-- The contain the carosuel --}}
    <div class="container carousel">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                @if($content->image1)
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                @endif
                @if($content->image2)
                    <li data-target="#carousel-example-generic" data-slide-to="1" ></li>
                @endif
                @if($content->image3)
                    <li data-target="#carousel-example-generic" data-slide-to="2" ></li>
                @endif
                @if($content->image4)
                    <li data-target="#carousel-example-generic" data-slide-to="3" ></li>
                @endif
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                @if($content->image1)
                    <div class="item active">
                        <img src="{{$content->image1}}" width="100%" alt="...">
                    </div>
                @endif
                @if($content->image2)
                    <div class="item">
                        <img src="{{$content->image2}}" width="100%" alt="...">
                    </div>
                @endif
                @if($content->image3)
                    <div class="item">
                        <img src="{{$content->image3}}" width="100%" alt="...">
                    </div>
                @endif
                @if($content->image4)
                    <div class="item">
                        <img src="{{$content->image4}}" width="100%" alt="...">
                    </div>
                @endif
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
            <div class="details" >
                {!! $content->detail !!}
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
                <a href="@{{ previous }}" v-show="previous" class="pull-left">Previous</a>
                <a href="@{{ next }}" v-show="next" class="pull-right">Next</a>
            </div>

            <div class="hidden-xs hidden-sm">
                <div class="row">
                    <div class="col-md-3" v-show="otherEvents[0]">
                        <a href="/events/@{{ otherEvent[0].content_identifier  }}">
                            <img src="@{{ otherEvents[0].image1 }}" class="img-responsive" alt="">
                            <p>@{{ otherEvents[0].summary }}</p>
                        </a>
                    </div>
                    <div class="col-md-3" v-show="otherEvents[1]">
                        <a href="/events/{{config("app.locale")}}/@{{ otherEvent[1].content_identifier  }}">
                            <img src="@{{ otherEvents[1].image1 }}" class="img-responsive" alt="">
                            <p>@{{ otherEvents[1].summary }}</p>
                        </a>
                    </div>
                    <div class="col-md-3" v-show="otherEvents[2]">
                        <a href="/events/{{config("app.locale")}}/@{{ otherEvent[2].content_identifier  }}">
                            <img src="@{{ otherEvents[2].image1 }}" class="img-responsive" alt="">
                            <p>@{{ otherEvents[2].summary }}</p>
                        </a>
                    </div>
                    <div class="col-md-3" v-show="otherEvents[3]">
                        <a href="/events/{{config("app.locale")}}/@{{ otherEvent[3].content_identifier  }}">
                            <img src="@{{ otherEvents[3].image1 }}" class="img-responsive" alt="">
                            <p>@{{ otherEvents[3].summary }}</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div id="calendar">

            </div>
            <span class="sr-only" layout-content="address" content-type="string">Address</span>
            <iframe width="100%" height="250" frameborder="0" style="border:0"
                    src="{{embedMapLink($content->address)}}" allowfullscreen style="border:0"></iframe>

            <div class="remark">
                <p>
                    {{$content->summary}}
                </p>
            </div>

            <div class="links hidden-md hidden-lg">
                <br />
                <a href="@{{ previous }}" v-show="previous"  class="pull-left clearfix btn btn-default btn-lg">Previous</a>
                <a href="@{{ next }}"  v-show="next" class="pull-right clearfix btn btn-default btn-lg">Next</a>
            </div>
        </div>
    </div>

    <script type="text/template" id="calTemplate" >
        <div class="clndr-controls">
            <div class="month"><%= month.toUpperCase() %></div>
        </div>
        <div class="clndr-grid">
            <div class="days-of-the-week">
                <div class="days">
                    <% _.each(days, function(day) { %>
                    <div class="<%= day.classes %>"><%= day.day %></div>
                    <% }); %>
                </div>
            </div>
        </div>
    </script>

@endsection

@section('scripts')
    <script>
        var eventDate = "{{convertDateTime($content->eventStartDate)}}";
        $('#calendar').clndr({
            template: document.querySelector("#calTemplate").innerHTML,
            startWithMonth: moment(eventDate,"YYYY-MM-DD"),
            events : [
                { date: eventDate, title: 'CLNDR GitHub Page Finished', url: 'http://github.com/kylestetz/CLNDR' }
            ]
        });


        var eventVue = new Vue({
            el: "#vue",
            data:{
                previous: null,
                next: null,
                otherEvents:[]
            },
            methods:{
                constructLinks: function(){
                    var queryCol, queryString;
                    queryCol = "eventStartDate";
                    queryString = moment(eventDate).format("YYYY-MM-DD");
                    this.$http.get('/api/search?page=events&'+queryCol+'='+queryString, function(data, status, request){
                        if( data.result.length > 1 ){
                          var currentContentIdentifier = "{{$content->content_identifier}}";
                          var newArray = data.result.sort(function(a,b){
                              return a.eventStartDate > b.eventStartDate? -1 : 1
                          });
                          for(var i = 0; i < newArray.length; i++){
                              if(newArray[i].content_identifier == currentContentIdentifier){
                                  if(i > 0){
                                      this.previous = "/events/"+newArray[i-1].content_identifier
                                  }
                                  if(i < newArray.length-1 ){
                                      this.next = "/events/"+newArray[i+1].content_identifier
                                  }
                              }
                          }
                      }
                    })
                },
                getSimilarEvents: function(){
                    var url, queryCol, queryString, queryCol1, queryString1;
                    queryCol = "cat";
                    queryString = "{{$content->cat}}";
                    queryCol1 = "lgt";
                    queryString1 = "eventStartDate,"+moment().format("YYYY-MM-DD");

                    url = '/api/search?page=events&'+queryCol+'='+queryString+"&"+queryCol1+"="+queryString1+"&limit=5";

                    this.$http.get( url , function(data, status, request){
                    var self = this;
                        data.result.filter(function(event){
                            return event.content_identifier !== "{{$content->content_identifier}}"
                        }).map(function(event){
                            self.otherEvents.push(event);
                        });
                    })
                }
            },
            ready: function(){
                this.constructLinks();
                this.getSimilarEvents();
            }
        })
    </script>

@endsection