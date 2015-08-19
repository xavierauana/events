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


//    Route::get('articles/detail', function(){
//        return view('front.pages.channel:articles');
//    });
//
//    Route::get('writers', function(){
//        return view('front.pages.channel:writers_index');
//    });
//
//    Route::get('writers/{id}', function(){
//        return view('front.pages.channel:writers');
//    });

    /*
     * This section is for routing page for login into back end system
     */
    require_once __DIR__."/Routes/systemRoutes.php";



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


    Route::get('login', function(){
        return view('front.pages.single:login');
    });
