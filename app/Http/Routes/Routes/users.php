<?php
    Route::resource('users', 'UsersController');
    Route::get('profile', array(
        'as' => 'admin.user.profile',
        'uses' => 'UsersController@profile',
    ));
    Route::patch('profile', array(
        'as' => 'updateProfile',
        'uses' => 'UsersController@updateProfile',
    ));
    Route::post('users/csv', 'UsersController@UploadCSV');
    Route::get('users/csv', function(){
        return view('back.users.csv');
    });