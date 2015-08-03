@extends('back.layouts.default')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>
                    <div class="panel-body">
                        {{Auth::user()->name}}, you have logged in.
                        <br />

                        <div class="panel panel-info">
                            <div class="panel-heading">Tracking</div>
                            <div class="panel-body">
                                <!-- Step 1: Create the containing elements. -->
                                <section id="auth-button" style=""></section>
                                <section id="view-selector"></section>
                                <section id="line-chart" class="col-xs-12"></section>
                                <section id="table-chart" class="col-xs-12"></section>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        (function(w,d,s,g,js,fjs){
            g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(cb){this.q.push(cb)}};
            js=d.createElement(s);fjs=d.getElementsByTagName(s)[0];
            js.src='https://apis.google.com/js/platform.js';
            fjs.parentNode.insertBefore(js,fjs);js.onload=function(){g.load('analytics')};
        }(window,document,'script'));
    </script>

    <script>
        gapi.analytics.ready(function(){

            console.log('lib loaded');
            var CLIENT_ID = '410214750622-tpdqchsupnb4rcemri0ct1c5s7rmf3cs.apps.googleusercontent.com';
            var SCOPE = 'https://www.googleapis.com/auth/analytics.readonly';
            var authData = {
                container:'auth-button',
                scopes: SCOPE,
                clientid: CLIENT_ID
            };
            var authObj = null;

            function getData(){
                console.log('call again');

                var data = new gapi.analytics.report.Data({
                    query: {
                        'ids':'ga:102466535',
                        'metrics': 'ga:sessions, ga:bounces',
                        'dimensions': 'ga:date',
                        'start-date': '30daysAgo',
                        'end-date': 'yesterday'
                    }
                });

                data.on('success', function(response) {
//                    console.log(response.query);
                    var dimensions = response.query.dimensions;
                    var metrics = response.query.metrics;
                    console.log(dimensions[0]);
                    console.log(metrics[0]);
                    $.each(response.rows, function(index, val){
                        console.log(val)
                    });

                });

                data.execute();
            }

                var lineChart = new gapi.analytics.googleCharts.DataChart({
                    query: {
                        ids: 'ga:102466535',
                        metrics: 'ga:sessions, ga:bounces',
                        dimensions: 'ga:date',
                        'start-date': '30daysAgo',
                        'end-date': 'yesterday'
                    },
                    chart: {
                        type: 'LINE',
                        container: 'line-chart',
                        options: {
                            title: 'Visits and Bounces over the past 30days.',
                            fontSize: 12,
                            width: '100%',
                            height: '100%'
                        }
                    }
                });
                lineChart.on('success', function(response) {
                    // response.chart : the Google Chart instance.
                    // response.data : the Google Chart data object.
                    console.log(response.chart);
                });
                var tableChart = new gapi.analytics.googleCharts.DataChart({
                    query: {
                        ids: 'ga:102466535',
                        metrics: 'ga:totalEvents',
                        dimensions: 'ga:eventCategory, ga:eventAction, ga:eventLabel',
                        'start-date': '30daysAgo',
                        'end-date': 'yesterday'
                    },
                    chart: {
                        type: 'TABLE',
                        container: 'table-chart',
                        options: {
                            title: 'Visits and Bounces over the past 30days.',
                            fontSize: 12,
                            width: '100%',
                            height: '100%'
                        }
                    }
                });
                tableChart.on('success', function(response) {
                    // response.chart : the Google Chart instance.
                    // response.data : the Google Chart data object.
                    console.log(response.chart);
                });

            gapi.analytics.auth.authorize(authData);

            gapi.analytics.auth.on('success', function(response){
                authObj = response;

                lineChart.execute();
                tableChart.execute();

            });


        })
    </script>
@endsection