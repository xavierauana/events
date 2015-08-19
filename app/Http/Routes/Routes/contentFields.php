<?php
    /**
     * Author: Xavier Au
     * Date: 20/8/15
     * Time: 12:04 AM
     */

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