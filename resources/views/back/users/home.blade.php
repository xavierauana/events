@extends("back.layouts.default")

@section("content")
    <main class="container">
       <h4>Favorites</h4>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Events</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Acticles</a></li>
            <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Writer</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <div class="row">
                    @foreach(Auth::user()->favorites()->whereType('events')->get() as $favorite)
                        <div class="col-xs-12">
                            <a href="/{{config('app.locale')}}/events/{{$favorite->content_identifier}}">
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <img src="{{$favorite->event->image1}}" alt="" class="img-responsive">
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-8">
                                    <p>
                                        {{$favorite->event->summary}}
                                    </p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="profile">
                Articles
            </div>
            <div role="tabpanel" class="tab-pane" id="messages">
                Writer
            </div>
        </div>
    </main>
@endsection