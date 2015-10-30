<?php

namespace App\Http\Controllers;

use App\Services\ManageMediaService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CKEditorController extends Controller
{
    private $mediaManager;

    /**
     * CKEditorController constructor.
     * @param $mediaManager
     */
    public function __construct(ManageMediaService $mediaManager)
    {
        $this->mediaManager = $mediaManager;
    }

    public function upload(Request $request)
    {
        $fileObject = $this->mediaManager->create($request->file("upload"));
        $funcNum = $request->CKEditorFuncNum;
        $url = $fileObject->link;
        $message = "image upload";
        return "<script type='text/javascript'> window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
    }
}
