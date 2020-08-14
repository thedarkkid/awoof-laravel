<?php


namespace App\Helpers\ScraperAdapters;


use App\Helpers\UtilityHelper;
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
     *
     * $baseURI is the URI of the online store being scraped
     * @param string $baseURI
     *
     * $searchSegment is an array of the strings that are added to the base URI and search query to form the endpoint
     * for the search request.
     * index [0] = string before search query.
     * index [1] = string after search query.
     * @param array $searchSegment
     *
     * $parentDOM is the css selector of DOM node that houses the search results
     * @param string $parentDOM
     *
     * $extractables is an array of objects, each called an "extractable".
     * The "extractable" objects determine what should be extracted from the $parentDOM children
     * on the page being crawled.
     *
     * Each object consists of three properties: "variable", "source", "attribute".
     *
     * "variable"; type string; the name the array variable returned from the scrape will have.
     * "source"; type string; the css selector of the html child of $parentDOM to be extracted.
     * "attribute"; type string; the name attribute to be extracted from the element whose css selector is provided
     * in the source.
     * @param array $extractables
     */


    public function __construct(string $baseURI = null, array $searchSegment = null, string $parentDOM = null, array $extractables = null)
    {
        if ($baseURI) $this->baseURI = $baseURI;
        if ($searchSegment) $this->searchSegment = $searchSegment;
        if ($parentDOM) $this->parentDOM = $parentDOM;
        if ($extractables) $this->extractables = $extractables;
        $this->scraper = new Client();
    }


    /**
     * sets $baseURI variable
     * @param string $baseURI
     */
    public function setBaseURI(string $baseURI)
    {
        $this->baseURI = $baseURI;
    }

    /**
     * @param array $searchSegment
     * sets $searchSegment variable
     */
    public function setSearchSegment(array $searchSegment)
    {
       $this->searchSegment = $searchSegment;
    }

    /** sets $parentDOM variable
     * @param string $parentDOM
     */
    public function setParentDOM(string $parentDOM)
    {
        $this->parentDOM = $parentDOM;
    }

    /**
     * sets extractables to a variable of "extractable" object
     * @param array $extractables
     */
    public function setExtractables(array $extractables)
    {
        $this->extractables = $extractables;
    }

    /**
     * sets the scrapper to a Goutte\Client object
     * @param $scraper
     */
    public function setScraper($scraper)
    {
        $this->scraper = $scraper;
    }

    /**
     * calls the extract function on base URI
     * @return array
     */
    public function scrape()
    {
        return $this->extract($this->baseURI);
    }


    /**
     * "searches" from a specified url and extracts data
     * @param $search_query
     * @return array
     */
    public function scrapeFromSearch($search_query)
    {
        if(count($this->searchSegment) > 1) return $this->extract($this->baseURI.$this->searchSegment[0].$search_query.$this->searchSegment[1]);
        else return $this->extract($this->baseURI.$this->searchSegment[0].$search_query);
    }

    /**
     * extracts data from the specified url, using $parentDOM and $extractables
     * @param string $url
     * @return array of extracted data
     */
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
                $item = $this->computeExtractables($item);
                if(!is_null($item) && $item["name"] != "")$items[] = $item;
            });
        }catch (\InvalidArgumentException $e){}

        return $items;
    }

    /**
     * computes some variable from array returned during web page extraction
     * @param array $item
     * @return array with computed properties
     */
    private function computeExtractables(array $item){
        try {
            if(array_key_exists("rating_text", $item)){
                $item['rating'] = intval(explode(" ", $item['rating_text'])[0]);
            }else{
                $item['rating_text'] = "0 out of 5";
                $item['rating'] = 0;
            }
            if(strpos($item["link"], "https://") === false){
                $item['link'] = $this->baseURI.$item["link"];
            }
            $item["store_name"] = UtilityHelper::return_store_name_from_URI($this->baseURI);
            $item["_price"] = $item["price"];
            $item["price"] = intval(preg_replace('/[^0-9]/', '', $item["price"]));
            return $item;
        }catch (\ErrorException $e){ return $item;}
    }


}
