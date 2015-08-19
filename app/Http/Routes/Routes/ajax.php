<?php
    Route::post("file",[
        "as"=>"admin.file.upload",
        "uses"=>"MediaController@uploadFile"
    ]);

    // this url cannot be change
    Route::get("files",[
        "as"=>"admin.files",
        "uses"=>"MediaController@getAllFiles"
    ]);

    // this url cannot be change
    Route::delete("file/{id}",[
        "as"=>"admin.file.delete",
        "uses"=>"MediaController@deleteFile"
    ]);
