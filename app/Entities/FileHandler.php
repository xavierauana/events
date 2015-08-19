<?php
/**
 * Author: Xavier Au
 * Date: 21/7/15
 * Time: 3:42 PM
 */

namespace App\Entities;


use App\Contracts\Entities\FileHandlerInterface;
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
class FileHandler implements FileHandlerInterface  {

    protected $path;
    private $prefix;

    /**
     * @param null $path
     */
    function __construct()
    {
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

        // move the upload file to the designated location
        $file->move($directory,$urlEncodeFileName);

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
}