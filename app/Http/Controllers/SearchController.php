<?php

namespace App\Http\Controllers;

use App\Helpers\Scraper;
use App\Helpers\ScraperAdapters\GoutteShopScraperAdapter;
use App\Traits\DisplayHelpers;
use App\Traits\ScraperHelpers;
use Illuminate\Http\Request;
use Goutte\Client;
class SearchController extends Controller
{
    use DisplayHelpers, ScraperHelpers;

    public function get_search_results(){
        $baseURI = 'https://www.jumia.com.ng';
        $searchSegment = "/catalog/?q=";
        $parentDOM = "div[data-catalog] article.prd";
        $extractables = [
            ["variable" => "link", "source" => 'a.core', "attribute" =>'href'],
            ["variable" => "img", "source" => 'div.img-c > img.img', "attribute" =>'data-src'],
            ["variable" => "name", "source" => 'div.info > h3.name', "attribute" =>'_text'],
            ["variable" => "price", "source" => 'div.info div.prc', "attribute" =>'_text'],
            ["variable" => "rating_text", "source" => 'div.info div.stars._s', "attribute" =>'_text'],

        ];

        $scraper = new Scraper(GoutteShopScraperAdapter::class, $baseURI, $searchSegment, $parentDOM, $extractables);
        $this->prettyDump($scraper->search("black+shoe"));

    }
    public function index(){
        return view('search.home');
    }

    public function result(){
        return view('search.result');
    }

    // todo implement cache system to store results
    public function single_product(){
        return view('search.single_product');
    }
}
