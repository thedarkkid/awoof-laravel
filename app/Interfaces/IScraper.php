<?php


namespace App\Interfaces;


interface IScraper
{
    public function setAdapter(IScraperAdapter $adapter);
    public function scrape(IScraperAdapter $adapter=null);
    public function search(string $search_query,IScraperAdapter $adapter = null);
}
