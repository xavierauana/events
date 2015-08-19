@extends('front.layouts.default')

@section('meta')
    <meta name="description" content="Events">
    <meta name="keywords" content="Hong Kongs,Events,July">
    <meta name="author" content="Xavier Au">
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
        <div class="col-md-4 col-xs-6 carouselContainer" index="@{{ $index }}" v-repeat="events">
            <div id="date-@{{ $index }}" class="carousel slide blocks @{{ class }} " data-interval="false" data-ride="carousel">
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div v-class="item:true, active: $index==0" v-repeat="items">
                        <div class="col-xs-7 imgContainer">
                            <img src="@{{ image1 }}"  alt="Chania">
                        </div>
                        <div class="col-xs-5 carousel-caption">
                            <p>@{{ summary }}</p>
                            <a href="/{{config("app.locale")}}/events/@{{ content_identifier }}" class="link_detail">More <i class="fa fa-chevron-right"></i></a>
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

    <div class="modal fade screen-centered" id="ajaxLoading">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <p class="text-center" style="margin-top: 20px"><i class="fa fa-spinner fa-pulse fa-2x text-center"></i></p>
                    <p class="text-center">Loading...</p>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection

@section('scripts')
    <script>
        var indexVue = new Vue({
            el: "#vue",
            methods:{
                changeMonth:function(delta){
                    this.currentMonth = moment().month(this.currentMonth).add(parseInt(delta), "M").format("MMMM").toUpperCase();
                    this.fetchEvents();
                },
                fetchEvents:function(){
                    var queryCol, monthQueryString;
                    monthQueryString =  moment().month(this.currentMonth).format("YYYY-MM-");
                    queryCol = "eventStartDate";
                    $("#ajaxLoading").modal('show');
var t0 = performance.now();
                    this.$http.get('/api/search?page=events&'+queryCol+'='+monthQueryString, function (data, status, request) {
var t1 = performance.now();
                        var groupByDate, dateWithEvents, vueEventArray, testingI, theClass;
                        groupByDate=[];
                        for (var i =1; i<=31 ; i++){
                            groupByDate[i] = data.result.filter(function(event){
                                var date;
                                date = moment(event[queryCol]).format("D")-1;
                                return date == i;
                            })
                        }

                        var removeDateWithNoEvents = function(date){
                            return date.length != 0
                        };
                        dateWithEvents = groupByDate.filter(removeDateWithNoEvents);
                        testingI=0;
                        theClass = "right";
                        vueEventArray = dateWithEvents.map(function(date){
                            if(testingI%3 == 0 && testingI >0){
                                theClass == "right"? theClass="left": theClass="right"
                            }
                            testingI++;
                            return {
                                class: theClass,
                                items: date
                            }
                        });
                        $("#ajaxLoading").modal('hide');
                        this.$set('events', vueEventArray);
var t2 =  performance.now();

console.log(t1-t0, t2-t1);
                    });
                }
            },
            ready:function(){
                this.$set("currentMonth", moment().format("MMMM").toUpperCase());
                this.fetchEvents();
            }
        })
    </script>
@endsection