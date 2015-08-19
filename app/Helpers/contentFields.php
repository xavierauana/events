<?php
    /**
     * Author: Xavier Au
     * Date: 5/8/15
     * Time: 2:58 PM
     */



    function getContentFieldTypes(){
        return [
            "string"=>"String",
            "text"=>"Text",
            "richtext"=>"Rich format text",
            "image"=>"Image",
            "file"=>"File",
            "datetime"=>"Date and Time"
        ];
    }

    function convertInputTypeToDbType($inputType){
        $conversionTable = [
            "string"=>"string",
            "text"=>"text",
            "richtext"=>"text",
            "image"=>"string",
            "file"=>"string",
            "datetime"=>"timestamp"
        ];
        return $conversionTable[$inputType];
    }