<?php
    /**
     * Author: Xavier Au
     * Date: 8/8/15
     * Time: 6:59 PM
     */

    namespace App\Services;


    use App\Contracts\Repositories\MediaInterface;
    use App\Entities\FileHandler;
    use Illuminate\Support\Facades\App;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Storage;
    use Intervention\Image\ImageManager;
    use Symfony\Component\HttpFoundation\File\UploadedFile;

    class ManageMediaService
    {
        private $media;

        /**
         * This is the relative path for update file store
         * @var string
         */
        private $baseDir = "files";
        private $filePrefix = "";

        /**
         * @return string
         */
        public function getFilePostfix()
        {
            return $this->filePostfix;
        }

        /**
         * @param string $filePostfix
         */
        public function setFilePostfix($filePostfix)
        {
            $this->filePostfix = $filePostfix;
        }

        /**
         * @return string
         */
        public function getFilePrefix()
        {
            return $this->filePrefix;
        }

        /**
         * @param string $filePrefix
         */
        public function setFilePrefix($filePrefix)
        {
            $this->filePrefix = $filePrefix;
        }
        private $filePostfix = "postFixTest";

        /**
         * MangeMediaService constructor.
         *
         * @param $media
         */
        public function __construct()
        {
            $this->media = App::make(MediaInterface::class);
            $this->filePrefix = time();
        }

        public function create(UploadedFile $file, $fileName = null, $path = null)
        {
            $fh = new FileHandler();

            $absolutePath = $fh->move($file, $fileName, $path);

            $media = $this->saveToDB($file, $absolutePath);

            return $media;
        }

        /**
         * @return string
         */
        public function getBaseDir()
        {
            return $this->baseDir;
        }

        /**
         * @param string $baseDir
         */
        public function setBaseDir($baseDir)
        {
            $this->baseDir = $baseDir;
        }

        /**
         * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
         */
        private function createFileName(UploadedFile $file)
        {
            $fileName = $file->getClientOriginalName();
            if ($this->filePrefix) {
                $fileName =  $this->filePrefix . "_" .$fileName;
            }
            if ($this->filePostfix) {
                $extension = $file->getClientOriginalExtension();
                $fileName = preg_replace('/.'.$extension.'$/', "", $fileName);
                $fileName .= "_" . $this->filePrefix.".$extension";
            }

            return urlencode($fileName);
        }

        private function getPath()
        {
            $path = $this->baseDir;
            return $path;
        }


        /**
         * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
         *
         * @return array
         */
        private function createDbData(UploadedFile $file, $completedPath)
        {
            $data = [];

            $type = $file->getClientMimeType();
            $fileName = $file->getClientOriginalName();

            $data["type"] = $type;
            $data["path"] = $completedPath;

            // TODO: need to fix for different storage location
            $data["link"] = str_replace(public_path(),"", $completedPath);

            $data["fileName"] = $fileName;
            $data["user_id"] = Auth::user()->id;

            return $data;
        }

        public function getAllFiles()
        {
            return $this->media->whereUserId(Auth::user()->id)->get();
        }

        public function deleteFile($id)
        {
            $file = $this->media->findOrFail($id);
            $disk = Storage::disk("public");
            $path = trim($file->path);
            if($disk->exists($path))
            {
                $disk->delete($path);
            }
            $file->delete();
        }

        private function saveToDB($file, $absoluteUrl)
        {
            $data = $this->createDbData($file, $absoluteUrl);
            return $this->media->create($data);
        }

    }