<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function toBackendDashboard(Request $request)
    {
        if($request->user()->hasRole(["administrator", "developer"])){
            return redirect()->route("admin.pages.index");
        }
        return view("back.users.home");
    }
}
