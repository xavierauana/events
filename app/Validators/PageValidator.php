<?php
/**
 * Created by PhpStorm.
 * User: adrianexavier
 * Date: 12/3/15
 * Time: 1:30 PM
 */

namespace App\Validators;



use App\Entities\Layout;
use App\Template;
use Illuminate\Support\Facades\App;

class PageValidator extends Validator {

    private $rules = array(
        'url' => 'required|alpha_dash|unique:pages,url',
        'active' => 'required|in:0,1',
    );

    protected $update = array(
        'active' => 'required|in:0,1',
    );

    protected $templateIds;

    /**
     * @param \App\Entities\Layout $layout
     */
    function __construct()
    {
        $this->templateIds = implode(",", App::make(Template::class)->lists("id")->toArray());
    }

    public function getUpdateRules($id)
    {
        $rules = $this->getBasicRules();
        if(property_exists($this,'update'))
        {
            $rules['url'] = "required|alpha_dash|unique:pages,url,$id";
        }
        return $rules;
    }

    public function getBasicRules()
    {
        $rules = $this->rules;
        $rules["template_id"] = "required|in:$this->templateIds";
        return $rules;
    }

    public function getStoreRules()
    {
        $rules = $this->getBasicRules();
        return $rules;
    }
}