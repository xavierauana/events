<?php
    /**
     * Author: Xavier Au
     * Date: 3/8/15
     * Time: 11:39 PM
     */

    /*
     * This section is all the operation in the backend CMS system
     */
    Route::group(array('middleware'=>'auth'), function(){

        Route::get('dashboard', array(
            'as'    => 'subs.dashboard',
            'uses'  =>  function(){
                return view('front.pages.single:dashboard');
            }
        ));

        Route::get('/admin/dashboard', [
            'middleware' => 'hasRole:administrator,developer',
            'as' => 'dashboard',
            'uses' => "HomeController@toBackendDashboard"
        ]);

        /*
         * These are routes for major function of the cms
         */
        Route::group(['prefix'=>'admin'], function(){
            require_once __DIR__."/Routes/pages.php";
            require_once __DIR__."/Routes/partials.php";
            require_once __DIR__."/Routes/users.php";
            require_once __DIR__."/Routes/settings.php";
            require_once __DIR__."/Routes/languages.php";
            require_once __DIR__."/Routes/menus.php";
            require_once __DIR__."/Routes/contents.php";
            require_once __DIR__."/Routes/ajax.php";


            /*
             * This is the section for managing role base authentication
             */
            Route::group(['prefix'=>'authentication'], function(){
                require_once __DIR__."/Routes/rolesandpermissions.php";
            });

            /*
             * This is the section for managing layouts templates
             */
            Route::group(['middleware'=>"hasRole:developer"], function(){
                require_once __DIR__."/Routes/templates.php";
                require_once __DIR__."/Routes/contentFields.php";
            });

        });

    });

    /**
     * The route response for handling login, logout, registration and password reset.
     */
    Route::controllers([
        'auth' => 'Auth\AuthController',
        'password' => 'Auth\PasswordController',
    ]);

    /**
     * The route response for handling api calls
     */
    Route::group(['prefix'=>'api'], function(){
        Route::any('/{segment1?}/{segment2?}/{segment3?}/{segment4?}', 'RoutesController@route');
    });

    /**
     * This route is manage request for front end
     */
    Route::get('/{segment1?}/{segment2?}/{segment3?}/{segment4?}', 'RoutesController@route');

