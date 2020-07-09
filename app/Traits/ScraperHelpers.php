<?php


namespace App\Traits;


trait ScraperHelpers
{
    /**
     * checks is a Symphony DomCrawler node is empty
     * @param $node
     * @return bool
     */
    public function goutteNodeEmpty($node){
//       $count = $node->count();
//       if($count > 2) return false;
//       else true;
        if($node->text()==="")return true;
        return false;
   }
}
