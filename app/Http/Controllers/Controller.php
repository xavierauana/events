<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    /**
     * @return mixed
     */
    protected function redirectWithInputsAndErrors()
    {
        return redirect()->back()->withInput()->withErrors($this->validator->messages);
    }
}
