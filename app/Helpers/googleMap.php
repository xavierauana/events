<?php

   function embedMapLink($address){
       $apiKey = "AIzaSyCc3IBYLZbsrM4P-iMGAwvY4yqkAWHXdbI";
       if($address){
           $refinedAddress = str_replace(" ", "+", $address);
       }else{
           $refinedAddress="Hong+Kong";
       }
       $link = "https://www.google.com/maps/embed/v1/place?q=$refinedAddress&key=$apiKey";
       return $link;
   }