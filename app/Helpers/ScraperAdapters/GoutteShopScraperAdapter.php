<?php


namespace App\Helpers\ScraperAdapters;


use App\Interfaces\IScraperAdapter;
use App\Traits\DisplayHelpers;
use Goutte\Client;
class GoutteShopScraperAdapter implements IScraperAdapter
{
    use DisplayHelpers;
    protected $baseURI;
    protected $searchSegment; // "/" inclusive
    protected $parentDOM;
    protected $extractables;
    protected $scraper;

    /**
     * GoutteShopScraperAdapter constructor.
     * @param $baseURI
     * @param $searchSegment
     * @param $parentDOM
     * @param $extractables
     * @param $scraper
     */
    public function __construct($baseURI = null, $searchSegment = null, $parentDOM = null, $extractables = null)
    {
        if ($baseURI) $this->baseURI = $baseURI;
        if ($searchSegment) $this->searchSegment = $searchSegment;
        if ($parentDOM) $this->parentDOM = $parentDOM;
        if ($extractables) $this->extractables = $extractables;
        $this->scraper = new Client();
    }


    /**
     * @param string $baseURI
     */
    public function setBaseURI(string $baseURI)
    {
        $this->baseURI = $baseURI;
    }

    /**
     * @param string $searchSegment
     */
    public function setSearchSegment(string $searchSegment)
    {
       $this->searchSegment = $searchSegment;
    }

    /**
     * @param string $parentDOM
     */
    public function setParentDOM(string $parentDOM)
    {
        $this->parentDOM = $parentDOM;
    }

    public function setExtractables(array $extractables)
    {
        $this->extractables = $extractables;
    }

    public function setScraper($scraper)
    {
        $this->scraper = $scraper;
    }

    public function scrape()
    {
        return $this->extract($this->baseURI);
    }


    public function scrapeFromSearch($search_query)
    {
        return $this->extract($this->baseURI.$this->searchSegment.$search_query);
    }

    private function extract(string $url){
        $crawler = $this->scraper->request('GET', $url);
        $items=[];

        try{
            $crawler->filter($this->parentDOM)->each(function($node)use(&$items){
                $item = [];
                foreach ($this->extractables as $extractable){
                    $content = $node->filter($extractable->source)->extract([$extractable->attribute]);
                    if(!empty($content)){
                        $item[$extractable->variable] = $content[0];
                    };
                }
//                $this->prettyDump($item);

                $item = $this->computeExtractables($item);
                if(!is_null($item))$items[] = $item;
            });
        }catch (\InvalidArgumentException $e){}

        return $items;
    }

    private function computeExtractables(array $item){
        try {
            if($item['rating']){
                $item['rating'] = explode(" ", $item['rating_text'])[0];
            }
            $item['link'] = $this->baseURI.$item["link"];
            return $item;
        }catch (\ErrorException $e){}
    }


}
