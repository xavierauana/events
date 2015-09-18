<?php

namespace App\Http\Controllers;

use App\Services\ManageMediaService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MediaController extends Controller
{
    private $mediaManager;

    /**
     * MediaController constructor.
     *
     * @param $mediaManager
     */
    public function __construct(ManageMediaService $mediaManager)
    {
        $this->mediaManager = $mediaManager;
    }


    public function uploadFile(Request $request)
    {
        if($request->ajax()){
            if($request->hasFile('file')){
                $fileObject = $this->mediaManager->create($request->file("file"));
                return ['testing'=>$fileObject];
//                return ['response'=>"completed", "message"=>"file upload and db update", "fileObject" => $fileObject];
            }
            return ['response'=>"error", "message"=>"no file upload", "fileObject" =>null];
        }
        return "this action is not allowed";
    }

    public function getAllFiles(Request $request)
    {
        if ($request->ajax()) {
            return $this->mediaManager->getAllFiles();
        }
    }

    public function deleteFile(Request $request, $id)
    {
        if($request->ajax()){
            $this->mediaManager->deleteFile($id);
            return ["response"=>"completed" ,'mediaId'=>$id];
        }
    }
}
