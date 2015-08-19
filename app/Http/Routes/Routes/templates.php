<?php

    Route::post('templates/createall', [
        "as"=>"admin.templates.createAll",
        "uses"=>"TemplatesController@createEverything"
    ]);
    Route::get('templates',[
        "as"=>"admin.templates.index",
        "uses"=>"TemplatesController@index"
    ]);