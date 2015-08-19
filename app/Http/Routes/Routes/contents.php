<?php
    Route::get('pages/{pageId}/contents', array(
        'as' => 'admin.pages.contents',
        'uses' => 'ContentsController@showPageContents'
    ));
    Route::post('pages/{pageId}/content',array(
        'as'=>'admin.contents.store',
        'uses'=>'ContentsController@updatePageContents'
    ));
    Route::get('pages/{pageId}/content/create',array(
        'as'=>'admin.contents.create',
        'uses'=>'ContentsController@createPageContents'
    ) );
    Route::get('pages/{pageId}/content/{identifier}/edit', array(
        'as' => 'admin.contents.edit',
        'uses' => 'ContentsController@editPageContents'
    ));
    Route::patch('pages/{pageId}/content/{identifier}', array(
        'as' => 'admin.contents.update',
        'uses' => 'ContentsController@updatePageContents'
    ));
    Route::delete('pages/{pageId}/content/{identifier}',array(
        'as' => 'admin.contents.delete',
        'uses' => 'ContentsController@deletePageContents'
    ));
