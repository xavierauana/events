<?php

namespace App\Http\Controllers;

use App\Entities\Layout;
use App\Events\RefreshCache;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DeveloperController extends Controller
{
    protected $layout;

    function __construct(Layout $layout)
    {
        $this->layout = $layout;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('back.dev.index');
    }

    public function refreshContentTables()
    {
        $this->layout->refreshContentTables();
        return redirect()->route('dev.index')->withMessage('Content tables have been refreshed.');
    }

    public function refreshTheLayoutTable(Request $request)
    {
        $table = $request->get("layout");
        $this->layout->dropLayoutTable($table);
        $this->layout->createALayoutTable($table);
        return redirect()->route('dev.index')->withMessage($table.' tables have been refreshed.');
    }

    public function cacheRefreshAll()
    {
        event(new RefreshCache('page', 'create'));
        return redirect()->route('dev.index')->withMessage('Content tables have been refreshed.');
    }
}
