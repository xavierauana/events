<?php
/**
 * Created by PhpStorm.
 * User: adrianexavier
 * Date: 24/4/15
 * Time: 5:49 PM
 */

namespace App\Validators;


class LanguageValidator extends Validator{

    private $rules = array(
        'display' => 'required',
        'code' => 'required|alpha_dash|unique:languages,code',
        'active' => 'required|in:0,1',
        'default' => 'required|in:0,1',
    );

    protected $update = array(
        'display' => 'required',
        'active' => 'required|in:0,1',
        'default' => 'required|in:0,1',
    );

    function getBasicRules()
    {
        return $this->rules;
    }

    function getStoreRules()
    {
        return $this->getBasicRules();
    }

    function getUpdateRules($id=null)
    {
        return $this->$update;
    }
}