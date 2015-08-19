<?php
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
    Route::post('refreshAll',array(
        'as'    =>  'refreshTheLayout',
        'uses'  =>  'DeveloperController@refreshContentTables'
    ));
