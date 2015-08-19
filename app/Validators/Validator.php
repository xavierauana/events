<?php
/**
 * Created by PhpStorm.
 * User: adrianexavier
 * Date: 11/3/15
 * Time: 6:36 PM
 */

namespace App\Validators;


use Illuminate\Support\Facades\Validator as V;

abstract class Validator {

    public $messages;

    protected $data;

    public function validate($inputs, $options=null, $id=null){
        $this->data = $inputs;
        foreach($inputs as $key=>$val)
        {
            if($val == "") unset($inputs[$key]);
        }
        $rules = $this->getRules($options, $id);
        $validation = V::make($inputs, $rules);
        if($validation->fails())
        {
            $this->messages = $validation->messages();
            return false;
        }
        return true;
    }

    private function getRules($options, $id)
    {
        if($options)
        {
            $method = "get".$options."Rules";
            return $this->$method($id);
        }
        return $this->getBasicRules();
    }

    public abstract function getBasicRules();
}