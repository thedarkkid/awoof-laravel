<?php


namespace App\Helpers;


class ErrorHelper
{
    public static function pt_not_created($pt){
        return $pt." has not been created yet, contact admin if error persists.";
    }

    public static function pt_non_existent($pt){
        return $pt." does not exist, are you sure the preference type is correct? contact admin if error persists.";
    }
}
