<?php


namespace App\Traits;


trait DisplayHelpers
{
    // display a variable in a readable format;
    function prettyDump($result){
        echo '<pre>';
        var_dump($result);
        echo '</pre>';
    }
}
