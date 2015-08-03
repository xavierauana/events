<?php
/**
 * Created by PhpStorm.
 * User: adrianexavier
 * Date: 12/3/15
 * Time: 1:30 PM
 */

namespace App\Validators;



use App\Entities\Layout;

class PageValidator extends Validator {

    private $layout;


    private $rules = array(
        'url' => 'required|alpha_dash|unique:pages,url',
        'active' => 'required|in:0,1',
        'layout' => 'required',
    );

    protected $update = array(
        'active' => 'required|in:0,1',
        'layout' => 'required',
    );

    /**
     * @param \App\Entities\Layout $layout
     */
    function __construct(Layout $layout)
    {
        $this->layout = $layout;
        $layouts = $this->layout->getAllLayouts();
        $this->setLayoutRule($layouts);
    }

    /**
     * @param array $layouts
     */
    private function setLayoutRule(array $layouts)
    {
        $rules = "in:";

        $keys = array_keys($layouts);
        foreach($keys as $index => $key)
        {
            $rules .= $key;
            if($index < count($keys)-1) $rules .=",";
        }
        $this->rules['layout'] = $rules;
    }

    function getUpdateRules($id=null)
    {
        if(property_exists($this,'update'))
        {
            $this->update['url'] = "required|alpha_dash|unique:pages,url,{$this->data['pageId']}";
            return $this->update;
        }else{
            $this->getBasicRules();
        }
    }

    function getBasicRules()
    {
        return $this->rules;
    }
    function getStoreRules()
    {
        if(property_exists($this, 'store'))
        {
            return $this->store;
        }else{
            return $this->rules;
        }
    }
}