<?php


namespace App\Traits;


trait DisplayHelpers
{

    function prettyDump($result){
        echo '<pre>';
        var_dump($result);
        echo '</pre>';
    }

    function print_collection(array $arr){
        $this->prettyDump(json_encode($arr));
    }

}
