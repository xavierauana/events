<?php
/**
 * Created by PhpStorm.
 * User: adrianexavier
 * Date: 11/3/15
 * Time: 6:36 PM
 */

namespace App\Validators;


class AuthValidator extends Validator {

    protected $rules = array(
        'email' => 'required|email',
        'password' => 'required',
    );
    protected $register = array(
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
    );


    function getBasicRules()
    {
        return $this->rules;
    }

    function getCreateRules()
    {
        // TODO: Implement getCreateRules() method.
    }

    function getUpdateRules($id=null)
    {
        // TODO: Implement getUpdateRules() method.
    }
    function getRegisterRules()
    {
        return $this->register;
    }

    function getStoreRules()
    {
        // TODO: Implement getStoreRules() method.
    }
}