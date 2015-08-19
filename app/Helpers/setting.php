<?php

    use App\Services\ManageSettingService;

    function setting($code = null, $value = null){
        $service = new ManageSettingService();
        if($code){
            if($value){
                return $service->set($code, $value);
            }
            return $service->get($code);
        }
        return $service;
    }