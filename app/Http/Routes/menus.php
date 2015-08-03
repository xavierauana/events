<?php

    Route::get('menus/index', array(
        'as' => 'admin.menus.index',
        'uses' => 'MenusController@index'
    ));
    Route::post('menus/{menuGroupId}/update',array(
        'as' => 'admin.menus.item.update',
        'uses' => 'MenusController@itemUpdate'
    ));

    Route::post('menus/store',array(
        'as' => 'admin.menus.group.store',
        'uses' => 'MenusController@store'
    ));
    Route::get('menus/create', array(
        'as' => 'admin.menus.group.create',
        'uses' => 'MenusController@create'
    ));
    Route::get('menus/{menuGroupId}/create', array(
        'as' => 'admin.menus.item.create',
        'uses' => 'MenusController@itemCreate'
    ));
    Route::post('menus/{menuGroupId}/store', array(
        'as' => 'admin.menus.item.store',
        'uses' => 'MenusController@itemStore'
    ));
    Route::get('menus/item/{menuId}/edit', array(
        'as' => 'admin.menus.item.edit',
        'uses' => 'MenusController@itemEdit'
    ));
    Route::patch('menus/item/{menuId}/update', array(
        'as' => 'admin.menus.item.update',
        'uses' => 'MenusController@itemUpdate'
    ));
    Route::delete('menus/item/{menuId}', array(
        'as' => 'admin.menus.item.destroy',
        'uses' => 'MenusController@itemDelete'
    ));
