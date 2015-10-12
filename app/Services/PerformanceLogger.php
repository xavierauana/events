<?php
/**
 * Author: Xavier Au
 * Date: 16/9/15
 * Time: 3:37 PM
 */

namespace App\Services;

class PerformanceLogger
{
    private $startTime;
    private $endTime;

    public function start()
    {
        $this->startTime = microtime(true);
    }
    public function end()
    {
        $this->endTime = microtime(true);
        $performance = ($this->endTime-$this->startTime)*1000;
        (new LogService())->log('The duration is '.$performance.' milisecond', "info" , "searchPerformance");
    }
}