<?php

namespace App\Http\Controllers;

use App\Entities\Migration;
use App\Template;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TemplatesController extends Controller
{
    private $template;

    /**
     * TemplatesController constructor.
     *
     * @param $template
     */
    public function __construct(Template $template)
    {
        $this->template = $template;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $templates = $this->template->all();
        return view("back.templates.index", compact("templates"));
    }

    public function createEverything()
    {
       $this->template->createAllPagesTemplateRecord();
       $this->template->createAllPartialsTemplateRecord();

        $layouts = $this->template->where("type","<>","partial")->get();
        $partials = $this->template->whereType("partial")->get();

        $this->createLayoutTables($layouts);
        $this->createPartialTables($partials);

        return redirect()->route("admin.templates.index");
    }

    private function createLayoutTables($layouts)
    {
        (new Migration())->createLayoutTablesOnly($layouts);
    }

    private function createPartialTables($partials)
    {
        (new Migration())->createPartialTablesOnly($partials);
    }
}
