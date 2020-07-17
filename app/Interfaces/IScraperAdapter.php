<?php


namespace App\Interfaces;


interface IScraperAdapter
{
    public function setBaseURI(string $baseURI);
    public function setSearchSegment(array $searchSegment);
    public function setParentDOM(string $parentDOM);
    public function setExtractables(array $extractables);
    public function setScraper($scraper);
    public function scrape();
    public function scrapeFromSearch($search_query);
}
