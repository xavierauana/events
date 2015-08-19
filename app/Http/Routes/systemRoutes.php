<?php
    /**
     * Author: Xavier Au
     * Date: 3/8/15
     * Time: 11:39 PM
     */

    /*
     * This section is all the operation in the backend CMS system
     */

    use App\Entities\Layout;

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

        Route::get('/admin/dashboard', [
            'middleware' => 'hasRole:administrator|developer',
            'as' => 'dashboard',
            'uses' => "HomeController@toBackendDashboard"
        ]);

        Route::group(['prefix'=>'admin'], function(){
            require_once __DIR__."/Routes/pages.php";
            require_once __DIR__."/Routes/partials.php";
            require_once __DIR__."/Routes/users.php";
            require_once __DIR__."/Routes/settings.php";
            require_once __DIR__."/Routes/languages.php";
            require_once __DIR__."/Routes/menus.php";
            require_once __DIR__."/Routes/contents.php";
            require_once __DIR__."/Routes/templates.php";
            require_once __DIR__."/Routes/ajax.php";

            Route::get("contentfields/check/{templateId}",[
                "as"=>"admin.contentfields.check",
                "uses"=>"ContentFieldsController@check"
            ]);
            Route::post("contentfields/{templateId}",[
                "as"=>"admin.contentfields.store",
                "uses"=>"ContentFieldsController@store"
            ]);
            Route::patch("contentfields/update/{templateId}",[
                "as"=>"admin.contentfields.update",
                "uses"=>"ContentFieldsController@update"
            ]);


            /*
             * This is the section for managing role base authentication
             */
            Route::group(['prefix'=>'authentication'], function(){
                require_once __DIR__."/Routes/rolesandpermissions.php";
            });

            /*
             * This is the section for managing layouts templates
             */
            Route::group(['prefix'=>'dev','middleware'=>"hasRole:developer"], function(){
                require_once __DIR__."/Routes/devlayouts.php";
            });

        });

    });

    Route::controllers([
        'auth' => 'Auth\AuthController',
        'password' => 'Auth\PasswordController',
    ]);


    Route::group(['prefix'=>'api'], function(){
        Route::any('/{segment1?}/{segment2?}/{segment3?}/{segment4?}', 'RoutesController@route');
    });

    Route::get('/{segment1?}/{segment2?}/{segment3?}/{segment4?}', 'RoutesController@route');

