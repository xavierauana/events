<?php
/**
 * Author: Xavier Au
 * Date: 21/7/15
 * Time: 3:42 PM
 */

namespace App\Entities;


use App\Contracts\Entities\FileHandlerInterface;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * If the form upload any file
 * the class will responsible to move the file to it's proper location
 * and return a link url
 *
 * Class FileHandler
 *
 * @package App\Entities
 */
class FileHandler implements FileHandlerInterface  {

    protected $path;
    private $prefix;
    private $intervention;

    /**
     * @param null $path
     */
    function __construct()
    {
        $this->intervention = new ImageManager();
        // set default path
        $this->path = public_path().'/files';
        $this->prefix = time();
    }

    /**
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
     * @param null                                                $filename
     * @param null                                                $directory
     *
     * @return string
     */
    public function move(UploadedFile $file, $filename=null, $directory=null)
    {
        // Is there custom file directory want to you? if no, user default file path
        $directory?: $directory = $this->path;

        // check the directory of the path is exsit or not. if not create the directory
        File::exists($this->path)?: File::makeDirectory($this->path);

        // is there any custom file name want to use? if no, use the file name
        $filename?: $filename = $file->getClientOriginalName();

        // decorate the filename
        $filename = $this->decorate($filename);

        $urlEncodeFileName = urlencode($filename);

        // adjust image size by Intervention and get back a intervention file object
        $file = $this->adjustFile($file);

        // move the upload file to the designated location
//        $file->save($directory."/".$urlEncodeFileName);
        $file->move($directory, $urlEncodeFileName);

        // return the absolute file path
        return "$this->path/$urlEncodeFileName";
    }

    private function decorate($filename)
    {
        return $this->prefix."_".$filename;
    }

    public function deleteFile($path)
    {
        // TODO: Implement deleteFile() method.
    }

    private function adjustFile($file)
    {
        $heightConstraint = 600;
        $widthConstraint = 800;

        $img = $this->intervention->make($file);

        if($img->height() > $img->width()){
            if($img->height() > $heightConstraint){
                $file = $img->resize(null, $heightConstraint, function($constraint){
                    $constraint->aspectRatio();
                });
            }
        }else{
            if($img->width() > $widthConstraint){
                $file = $img->resize($widthConstraint, null, function($constraint){
                    $constraint->aspectRatio();
                });
            }
        }
        return $file;

    }
}