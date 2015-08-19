<?php
    /**
     * Author: Xavier Au
     * Date: 19/8/15
     * Time: 12:18 PM
     */

    namespace App\Contracts\Entities;


    use Symfony\Component\HttpFoundation\File\UploadedFile;

    interface FileHandlerInterface
    {
        public function move(UploadedFile $file, $filename=null, $directory=null);

        public function deleteFile($path);
    }