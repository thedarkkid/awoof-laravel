<?php

namespace App\Http\Controllers;

use App\Helpers\Scraper;
use App\Helpers\ScraperAdapters\GoutteShopScraperAdapter;
use App\Http\Requests\Search\SearchQueryRequest;
use App\Traits\DisplayHelpers;
use App\Traits\ScraperHelpers;
use Illuminate\Http\Request;
use Goutte\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use stdClass;

class SearchController extends Controller
{
    use DisplayHelpers, ScraperHelpers;

    private $jumia_scraper_params;
    private $slot_scraper_params;
    private $kara_scraper_params;

    private $jumia_scraper;
    private $slot_scraper;
    private $kara_scraper;

    public function __construct()
    {
        // initialise scrapers and scrapers parameters
        $this->initialize_scrapers_params("/scrapers.config.json");
        $this->initialize_scrapers();
    }

    public function index(){
        return view('search.home');
    }

    public function result(){
        return view('search.result');
    }

    // todo implement cache system to store results
    // todo add store image to individual result
    // todo implement pagination correctly
    // todo fix image loading problem

    public function single_product(){
        return view('search.single_product');
    }

    public function get_search_results(SearchQueryRequest $request){
        // display scraper data
        $query = $request->validated()["query"];
        $result = $this->search_and_extract($query);

        $_results = new LengthAwarePaginator($result, count($result), 10);
//        $this->prettyDump($_results);
        return view('search.result')->with(["products" => $_results, "query" => $query]);
    }

    private function initialize_scrapers_params(string $param_file_path){
        // get the configuration to use scrapers
        $scraper_file  = file_get_contents(base_path().$param_file_path);
        $scraper_config= json_decode($scraper_file);

        // set scraper params to class properties
        $this->jumia_scraper_params = $scraper_config->jumia;
        $this->slot_scraper_params = $scraper_config->slot;
        $this->kara_scraper_params = $scraper_config->kara;
    }

    private function initialize_scrapers(){
        $this->initialize_jumia_scraper();
        $this->initialize_slot_scraper();
        $this->initialize_kara_scraper();
    }

    private function initialize_jumia_scraper(){
        // pull jumia scraper config
        $jumia_scraper_config = $this->jumia_scraper_params;

        // initialise scraper
        $this->jumia_scraper = new Scraper(
            GoutteShopScraperAdapter::class,
            $jumia_scraper_config->baseURI,
            $jumia_scraper_config->searchSegment,
            $jumia_scraper_config->parentDOM,
            $jumia_scraper_config->extractables
        );
    }

    private function initialize_slot_scraper(){
        // pull scraper config
        $slot_scraper_config = $this->slot_scraper_params;

        // initialise scraper
        $this->slot_scraper = new Scraper(
            GoutteShopScraperAdapter::class,
            $slot_scraper_config->baseURI,
            $slot_scraper_config->searchSegment,
            $slot_scraper_config->parentDOM,
            $slot_scraper_config->extractables
        );
    }

    private function initialize_kara_scraper(){
        // pull scraper config
        $kara_scraper_config = $this->kara_scraper_params;

        // initialise scraper
        $this->kara_scraper = new Scraper(
            GoutteShopScraperAdapter::class,
            $kara_scraper_config->baseURI,
            $kara_scraper_config->searchSegment,
            $kara_scraper_config->parentDOM,
            $kara_scraper_config->extractables
        );
    }

    private function search_and_extract(string $query){
//        $_jumia = $this->jumia_scraper->search($query);
//        $_slot = $this->slot_scraper->search($query);
        $_jumia = [];
        $_slot = [];
        $_kara = $this->kara_scraper->search($query);

        $result = array_merge(array_merge($_jumia, $_slot), $_kara);
        shuffle($result);

        return $result;
    }

}
