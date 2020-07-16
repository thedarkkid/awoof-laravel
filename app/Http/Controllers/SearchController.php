<?php

namespace App\Http\Controllers;

use App\Helpers\Scraper;
use App\Helpers\ScraperAdapters\GoutteShopScraperAdapter;
use App\Traits\DisplayHelpers;
use App\Traits\ScraperHelpers;
use Illuminate\Http\Request;
use Goutte\Client;
use stdClass;

class SearchController extends Controller
{
    use DisplayHelpers, ScraperHelpers;

    private $jumia_scraper_params;
    private $slot_scraper_params;
    private $kara_scraper_params;

    private $jumia_scraper;
    private $konga_scraper;
    private $kara_scraper;

    public function __construct()
    {
        // get the configuration to use scrapers
        $scraper_file  = file_get_contents(base_path()."/scrapers.config.json");
        $scraper_config= json_decode($scraper_file);

        // utilise the scraper data
        $this->jumia_scraper_params = $scraper_config->jumia;
        $this->slot_scraper_params = $scraper_config->slot;
        $this->kara_scraper_params = $scraper_config->kara;

        // initialise scrapers
        $this->initialize_scrapers();
    }

    public function get_search_results(){
        // display scraper data
        $this->prettyDump($this->konga_scraper->search("black+shoe"));

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

    private function initialize_scrapers(){
        $this->initialize_jumia_scraper();
        $this->initialize_konga_scraper();
//        $this->initialize_kara_scraper();
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
}
