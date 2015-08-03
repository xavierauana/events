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

    /*
 * This section is for routing page for login into back end system
 */

    /*
     * This section is all the operation in the backend CMS system
     */

    Route::group(array('middleware'=>'auth'), function(){

        Route::get('dashboard', array(
            'as'    => 'subs.dashboard',
            'uses'  =>  function(){
                return View::make('front.pages.single:dashboard');
            }
        ));
        Route::get('/admin/CKEditorFileBrowser', function(){
//        return Input::all();
            $medias = Media::all();
            return View::make('back.ckeditor.browser',compact('medias'));
        });

        Route::get('/admin/dashboard', array(
            'as' => 'dashboard',
            'uses' => "HomeController@toBackendDashboard"
        ))->before('is:admin|dev');
        Route::get('/admin/profile', array(
            'as' => 'admin.profile',
            'uses' => 'UsersController@profile',
        ));
        Route::PATCH('/admin/users/{id}', array(
            'uses' => 'UsersController@update',
        ));
        Route::group(array('prefix'=>'admin'), function(){

            Route::post('users/csv', 'UsersController@UploadCSV');
            Route::get('users/csv', function(){
                return View::make('back.users.csv');
            });

            Route::resource('pages', 'PagesController');
            Route::resource('partials', 'PartialsController');
            Route::resource('users', 'UsersController');
            Route::resource('settings', 'SettingsController');

            Route::resource('languages', 'LanguagesController');


            //TODO:: inject menus routes here
            require_once __DIR__."/Routes/menus.php";


            Route::get('contents/{pageId}/{layoutType}', array(
                'as' => 'admin.pages.content',
                'uses' => 'ContentsController@showPageContents'
            ));
            Route::get('contents/{pageId}/{layoutType}/create',array(
                'as'=>'admin.contents.create',
                'uses'=>'ContentsController@createPageContents'
            ) );
            Route::get('contents/{pageId}/{layoutType}/{identifier}/edit', array(
                'as' => 'admin.contents.edit',
                'uses' => 'ContentsController@editPageContents'
            ));
            Route::patch('contents/{pageId}/{layoutType}/{identifier}', array(
                'as' => 'admin.contents.update',
                'uses' => 'ContentsController@updatePageContents'
            ));
            Route::delete('contents/{pageId}/{layoutType}/{identifier}',array(
                'as' => 'admin.contents.delete',
                'uses' => 'ContentsController@deletePageContents'
            ));
            Route::post('contents/{pageId}/{layoutType}',array(
                'as'=>'admin.contents.store',
                'uses'=>'ContentsController@updatePageContents'
            ));

            /*
             * This is the section for managing role base authentication
             */
            Route::group(array('prefix'=>'authentication'), function(){
                Route::resource('users', 'UsersController');
                Route::resource('roles', "\\Xavierau\\RoleBaseAuthentication\\Controllers\\RolesController");
                Route::resource('permissions', "\\Xavierau\\RoleBaseAuthentication\\Controllers\\PermissionsController");
            });

            /*
             * This is the section for managing layouts templates
             */
            Route::group(array('prefix'=>'dev'), function(){
//            Route::get('layouts', array(
//                'as'    =>  'dev.layouts.index',
//                'uses'  =>  'LayoutsController@index'
//            ));
                Route::get('index', array(
                    'as'    =>  'dev.index',
                    'uses'  =>  'DeveloperController@index'
                ));
                Route::get('cache/refreshall', array(
                    'as'    =>  'cache.refreshall',
                    'uses'  =>  'DeveloperController@cacheRefreshAll'
                ));
                Route::get('refreshAll',array(
                    'as'    =>  'refreshAllLayoutsAndContents',
                    'uses'  =>  'DeveloperController@refreshContentTables'
                ));
            });
        });

    });


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
