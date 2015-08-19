<?php
    /**
     * Author: Xavier Au
     * Date: 19/8/15
     * Time: 4:42 PM
     */

    namespace App\Services;


    use Illuminate\Support\Facades\Log;
    use Monolog\Handler\StreamHandler;
    use Monolog\Logger;

    class LogService
    {
        private $monolog;
        private $path;
        private $type;
        private $file;

        /**
         * LogService constructor.
         *
         * @param $monolog
         */
        public function __construct()
        {
            $this->monolog = Log::getMonolog();
            $this->path = storage_path().'/logs/';
            $this->type = Logger::INFO;
            $this->file = "laravel.log";
        }

        public function log($message, $type=null, $file=null, $path=null)
        {
            $path?:$path = $this->path;
            $file?:$file = $this->file;
            switch ($type) {
                case "emergency":
                    $type = Logger::EMERGENCY;
                    break;
                case "alert":
                    $type = Logger::ALERT;
                    break;
                case "critical":
                    $type = Logger::CRITICAL;
                    break;
                case "error":
                    $type = Logger::ERROR;
                    break;
                case "warning":
                    $type = Logger::WARNING;
                    break;
                case "notice":
                    $type = Logger::NOTICE;
                    break;
                case "debug":
                    $type = Logger::DEBUG;
                    break;
                default:
                    $type = $this->type;
            }
            $this->monolog->pushHandler(new StreamHandler($path.$file, $type ));
            $this->monolog->addInfo($message);
        }






    }