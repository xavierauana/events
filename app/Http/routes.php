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


use Illuminate\Http\Request;
//
//Route::get('writers', function(){
//   return View::make('front.pages.channel:writers_index');
//});
//
//Route::get('writers/detail', function(){
//   return View::make('front.pages.channel:writers');
//});


Route::get('fbLoginCallback', function(Request $request){
    $fb = new Facebook\Facebook([
        'app_id' => '957752467615435',
        'app_secret' => env("FACEBOOK_SECRET"),
        'default_graph_version' => 'v2.4',
    ]);

    $helper = $fb->getRedirectLoginHelper();

    try {
        $accessToken = $helper->getAccessToken();
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
    dd($accessToken);
});
    /*
     * This section is for routing page for login into back end system
     */
    require_once __DIR__."/Routes/systemRoutes.php";