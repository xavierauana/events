<?php
/**
 * Author: Xavier Au
 * Date: 21/7/15
 * Time: 3:42 PM
 */

namespace App\Entities;


use Illuminate\Support\Facades\File;
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
class FileHandler {

    protected $path;

    function __construct($path=null)
    {
        $path ? $this->path = $path : $this->path = public_path().'/files';
        if(!File::exists($this->path)) File::makeDirectory($this->path);
    }

    public function move(UploadedFile $file, $filename=null, $directory=null)
    {
        if(!$filename) $filename = $file->getClientOriginalName();
        if(!$directory) $directory = $this->path;
        $file->move($directory,$filename);
        return $directory.'/'.$filename;
    }
}