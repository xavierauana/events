<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\PageInterface;
use App\Entities\Layout;
use App\Events\RefreshCache;
use App\Validators\PageValidator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{

    protected $validator;
    private $baseRoute = 'admin.pages.';
    private $basePage = 'back.pages.';
    private $page;

    /**
     * Validator for form inputs
     *
     * @param \App\Validators\PageValidator             $validator
     * @param \App\Contracts\Repositories\PageInterface $page
     */
    function __construct(PageValidator $validator, PageInterface $page)
    {
        $this->validator = $validator;
        $this->page = $page;
    }


    /**
     * Display a listing of pages
     *
     * @return Response
     */
    public function index()
    {
        $pages = $this->page->all();
        return view($this->basePage.'index', compact('pages'));
    }

    /**
     * Show the form for creating a new page
     *
     * @return Response
     */
    public function create()
    {
        $layout = new Layout();
        $layouts = $layout->getAllLayouts();
        $message='Page created.';
        return view($this->basePage.'create', compact('layouts'))->withMessage($message);
    }

    /**
     * Store a newly created page in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Http\Controllers\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if($this->validator->validate($data,__FUNCTION__))
        {
            $this->page->create($data);
            event(new RefreshCache("page", "create"));
            return redirect()->route($this->baseRoute.'index');
        }

        return $this->redirectWithInputsAndErrors();

    }

    /**
     * Display the specified page.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $page = $this->page->findOrFail($id);

        return view($this->basePage.'show', compact('page'));
    }

    /**
     * Show the form for editing the specified page.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $layout = new Layout();
        $layouts = $layout->getAllLayouts();
        $page = $this->page->findOrFail($id);
        return view($this->basePage.'edit', compact('page','layouts'));
    }

    /**
     * Update the specified page in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $data = $request->all();
        $checking = $data;
        $checking['pageId'] = $id;
        if($this->validator->validate($checking,__FUNCTION__))
        {
            $page = $this->page->findOrFail($id);
            $page->update($data);
            event(new RefreshCache("page", "update"));
            $message = 'Page Updated.';
            return redirect()->route($this->baseRoute.'index')->withMessage($message);
        }
        return $this->redirectWithInputsAndErrors();
    }

    /**
     * Remove the specified page from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        if($this->page->destroy($id))
        {
            event(new RefreshCache("page", "delete"));
        }

        if($request->ajax())
        {
            return ['response'=>'completed'];
        }
        return redirect()->route($this->basePage.'index');
    }

    protected function redirectWithInputsAndErrors()
    {
        return redirect()->back()->withInput()->withErrors($this->validator->messages);
    }
}
