<?php

use Carbon\Carbon;

if(!function_exists('carbonParse')){
    function carbonParse($dateTime){
        return Carbon::parse($dateTime);
    }
}

if(!function_exists('storeCurrentUserSession')){
    function storeCurrentUserSession($loginData){
        if(session()->has('_amToken')){
            session()->forget('_amToken');
        }
        $encryptedData = encrypt($loginData);
        session()->put('_amToken', (array)$encryptedData);
    }
}

if(!function_exists('retriveCurrentUserSession')){
    function retriveCurrentUserSession(){
        if(session()->has('_amToken')){
            $sessionData = session()->get('_amToken');
            return decrypt($sessionData);
        }
    }
}

if(!function_exists('removeCurrentUserSession')){
    function removeCurrentUserSession(){
        if(session()->has('_amToken')){
            session()->forget('_amToken');
        }
    }
}

