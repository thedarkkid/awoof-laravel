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

    public static function sort_multi_array_by_key(array $array, string $key, string $order="desc"){
        uasort($array, function($a, $b) use($key, $order) {
            if($order == "desc") return $b[$key] <=> $a[$key];
            else return $a[$key] <=> $b[$key];
        });
        return $array;
    }

    public static function return_store_name_from_URI(string $uri){
        $domain = parse_url($uri)["host"];
        $domain = str_ireplace('www.', '', $domain);
        $domain = str_ireplace('.com', '', $domain);
        $domain = str_ireplace('.ng', '', $domain);

        return ucfirst($domain);

    }
}
