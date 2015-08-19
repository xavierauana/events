<?php

    function convertDateTime($timeStamp, $pattern=null){
        $pattern ? $format = $pattern : $format = "Y-m-d";
        $time = strtotime($timeStamp);
        return date($format, $time);
    }

    function convertDateTimeForBackEnd($timeStamp, $pattern = null){
        if($timeStamp){
            $pattern ? $format = $pattern : $format = "jS F Y h:i A";
            $time = strtotime($timeStamp);
            return date($format, $time);
        }
        return "";
    }