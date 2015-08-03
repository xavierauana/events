<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\LanguageInterface;
use App\Events\RefreshCache;
use App\Validators\LanguageValidator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class LanguagesController extends Controller
{
    protected $validator;
    private $language;
    private $baseRoute = 'admin.languages.';
    private $basePage = 'back.languages.';

    function __construct(LanguageValidator $validator, LanguageInterface $language)
    {
        $this->language = $language;
        $this->validator = $validator;
    }


    /**
     * Display a listing of languages
     *
     * @return Response
     */
    public function index()
    {

        $languages = $this->language->all();

        return view($this->basePage.'index', compact('languages'));
    }

    /**
     * Show the form for creating a new language
     *
     * @return Response
     */
    public function create()
    {
        return view($this->basePage.'create');
    }

    /**
     * Store a newly created language in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if($this->validator->validate($data,__FUNCTION__))
        {
            $this->language->create($data);
            event( new RefreshCache("language", "create"));
            $message = 'A new language is added.';
            return redirect()->route($this->baseRoute.'index')->withMessage($message);
        }
        $this->redirectWithInputsAndErrors();

    }

    /**
     * Display the specified language.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $language = $this->language->findOrFail($id);

        return view($this->basePage.'show', compact('language'));
    }

    /**
     * Show the form for editing the specified language.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $language = $this->language->findOrFail($id);

        return view($this->basePage.'edit', compact('language'));
    }

    /**
     * Update the specified language in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $requests)
    {
        $language = $this->language->findOrFail($id);

//		$validator = Validator::make($data = Input::all(), Acme\models\core\$this->language->$rules);
//
//		if ($validator->fails())
//		{
//			return Redirect::back()->withErrors($validator)->withInput();
//		}

        $language->update($requests->all());

        event( new RefreshCache("language", "update"));
        return redirect()->route($this->baseRoute.'index');
    }

    /**
     * Remove the specified language from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        $this->language->findOrFail($id)->delete();
        event(new RefreshCache("language", "delete"));

        if($request->ajax())
        {
            return Response::json(array('response'=>'completed'));
        }
        return redirect()->route($this->basePage.'index');

    }
}
