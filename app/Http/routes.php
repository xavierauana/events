<?php

    /*
    |--------------------------------------------------------------------------
    | Application Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the routes for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */

    Route::get('test', function(){
        return view('test');
    });

//    Route::get('/', 'WelcomeController@index');
    Route::get('/', [
        "as"=>"home",
        "uses" => function(){
            return view('front.pages.single:index');
        }
    ]);

    Route::get('basic', function(){
        return view('front.pages.single:basic');
    });

    Route::get('events', function(){
        return view('front.pages.channel:events_index');
    });
    Route::get('events/detail/{id?}', function(){
        return view('front.pages.channel:events');
    });

    Route::get('articles', function(){
        return view('front.pages.channel:articles_index');
    });
    Route::get('articles/detail', function(){
        return view('front.pages.channel:articles');
    });

    Route::get('eventdetail', function(){
        return view('front.pages.channel:event');
    });
    Route::get('july', function(){
        return view('front.pages.single:month');
    });
    Route::get('contact', function(){
        return view('front.pages.single:contact');
    });
    Route::get('about', function(){
        return view('front.pages.single:about');
    });
    Route::get('groups', function(){
        return view('front.pages.channel:groups_index');
    });
    Route::get('writers', function(){
        return view('front.pages.channel:writers_index');
    });
    Route::get('writers/{id}', function(){
        return view('front.pages.channel:writers');
    });
    Route::get('login', function(){
        return view('front.pages.single:login');
    });

    Route::controllers([
        'auth' => 'Auth\AuthController',
        'password' => 'Auth\PasswordController',
    ]);





    Route::get('api/getEvent/{date}/{token}', function($date, $token){
        if($token == csrf_token()){
           //
           // logic to get data from db and return to client
           //

            $data = createObject();

            $response = true;
            $error = "Token match";
        }else{
            $response = false;
            $error = "Token mismatch";
        }
       return compact('response', 'error', 'data') ;
    });


    function createObject(){
        $data=[
            [
                "date"=>1,
                "numberOfEvents"=>2,
                "events"=>[
                    [
                        "id"=>"event1",
                        'image'=>"http://lorempixel.com/200/400/abstract/Dummy-Text/",
                        "description"=>"Event 1 description"
                    ],
                    [
                        "id"=>"event2",
                        'image'=>"http://lorempixel.com/200/400/city/Dummy-Text/",
                        "description"=>"Event 2 description"
                    ]
                ]
            ],
            [
                "date"=>2,
                "numberOfEvents"=>2,
                "events"=>[
                    [
                        "id"=>"event1",
                        'image'=>"http://lorempixel.com/200/400/abstract/Dummy-Text/",
                        "description"=>"Event 1 description"
                    ],
                    [
                        "id"=>"event2",
                        'image'=>"http://lorempixel.com/200/400/city/Dummy-Text/",
                        "description"=>"Event 2 description"
                    ]
                ]
            ],
            [
                "date"=>3,
                "numberOfEvents"=>2,
                "events"=>[
                    [
                        "id"=>"event1",
                        'image'=>"http://lorempixel.com/200/400/abstract/Dummy-Text/",
                        "description"=>"Event 1 description"
                    ],
                    [
                        "id"=>"event2",
                        'image'=>"http://lorempixel.com/200/400/city/Dummy-Text/",
                        "description"=>"Event 2 description"
                    ]
                ]
            ],
            [
                "date"=>4,
                "numberOfEvents"=>2,
                "events"=>[
                    [
                        "id"=>"event1",
                        'image'=>"http://lorempixel.com/200/400/abstract/Dummy-Text/",
                        "description"=>"Event 1 description"
                    ],
                    [
                        "id"=>"event2",
                        'image'=>"http://lorempixel.com/200/400/city/Dummy-Text/",
                        "description"=>"Event 2 description"
                    ]
                ]
            ],
            [
                "date"=>5,
                "numberOfEvents"=>2,
                "events"=>[
                    [
                        "id"=>"event1",
                        'image'=>"http://lorempixel.com/200/400/abstract/Dummy-Text/",
                        "description"=>"Event 1 description"
                    ],
                    [
                        "id"=>"event2",
                        'image'=>"http://lorempixel.com/200/400/city/Dummy-Text/",
                        "description"=>"Event 2 description"
                    ]
                ]
            ],
            [
                "date"=>6,
                "numberOfEvents"=>2,
                "events"=>[
                    [
                        "id"=>"event1",
                        'image'=>"http://lorempixel.com/200/400/abstract/Dummy-Text/",
                        "description"=>"Event 1 description"
                    ],
                    [
                        "id"=>"event2",
                        'image'=>"http://lorempixel.com/200/400/city/Dummy-Text/",
                        "description"=>"Event 2 description"
                    ]
                ]
            ],
            [
                "date"=>7,
                "numberOfEvents"=>2,
                "events"=>[
                    [
                        "id"=>"event1",
                        'image'=>"http://lorempixel.com/200/400/abstract/Dummy-Text/",
                        "description"=>"Event 1 description"
                    ],
                    [
                        "id"=>"event2",
                        'image'=>"http://lorempixel.com/200/400/city/Dummy-Text/",
                        "description"=>"Event 2 description"
                    ]
                ]
            ],
            [
                "date"=>8,
                "numberOfEvents"=>2,
                "events"=>[
                    [
                        "id"=>"event1",
                        'image'=>"http://lorempixel.com/200/400/abstract/Dummy-Text/",
                        "description"=>"Event 1 description"
                    ],
                    [
                        "id"=>"event2",
                        'image'=>"http://lorempixel.com/200/400/city/Dummy-Text/",
                        "description"=>"Event 2 description"
                    ]
                ]
            ],
            [
                "date"=>9,
                "numberOfEvents"=>2,
                "events"=>[
                    [
                        "id"=>"event1",
                        'image'=>"http://lorempixel.com/200/400/abstract/Dummy-Text/",
                        "description"=>"Event 1 description"
                    ],
                    [
                        "id"=>"event2",
                        'image'=>"http://lorempixel.com/200/400/city/Dummy-Text/",
                        "description"=>"Event 2 description"
                    ]
                ]
            ],
            [
                "date"=>10,
                "numberOfEvents"=>2,
                "events"=>[
                    [
                        "id"=>"event1",
                        'image'=>"http://lorempixel.com/200/400/abstract/Dummy-Text/",
                        "description"=>"Event 1 description"
                    ],
                    [
                        "id"=>"event2",
                        'image'=>"http://lorempixel.com/200/400/city/Dummy-Text/",
                        "description"=>"Event 2 description"
                    ]
                ]
            ],
            [
                "date"=>11,
                "numberOfEvents"=>2,
                "events"=>[
                    [
                        "id"=>"event3",
                        'image'=>"http://lorempixel.com/200/400/city/Dummy-Text/",
                        "description"=>"Event 3 description"
                    ],
                    [
                        "id"=>"event4",
                        'image'=>"http://lorempixel.com/200/400/city/Dummy-Text/",
                        "description"=>"Event 4 description"
                    ]
                ]
            ]

        ];
        return $data;
    }
