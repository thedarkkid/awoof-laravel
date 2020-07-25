<?php


namespace App\Helpers;


class UtilityHelper
{
    public static function goutteNodeEmpty($node){
        if($node->text()==="")return true;
        return false;
    }

    public static function merge_arrays(array $arr){
        $merged = [];
        for($i=0; $i < count($arr); $i++){
            $merged = array_merge($merged, $arr[$i]);
        }
        return $merged;
    }

    public static function sort_multi_array_by_key(array $array, string $key){
        usort($array, function($a, $b) use($key) {
            return $a[$key] <=> $b[$key];
        });
        return $array;
    }
}
