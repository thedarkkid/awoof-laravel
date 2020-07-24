<?php

namespace App\Models;

use App\Helpers\Scraper;
use App\Helpers\ScraperAdapters\GoutteShopScraperAdapter;
use App\Interfaces\ScraperModel;
use stdClass;

class Store implements ScraperModel
{
    protected string $config_file_path = "";
    protected object $scraper_config;
    protected stdClass $store_scrapers;
    protected array $stores = [];
    protected array $shopping_priorities = [];
    protected object $cache;

    public function __construct(string $config_file_path = null, array $stores = null)
    {
        $this->config_file_path = !is_null($config_file_path) ? base_path().$config_file_path: base_path()."/scrapers.config.json";
        $this->scraper_config  = file_get_contents(base_path().$config_file_path);
        $this->initialize_stores_scrapers($stores);
    }

    public function set_config_file_path(string $config_file_path)
    {
        $this->config_file_path = !is_null($config_file_path) ? base_path() . $config_file_path : base_path() . "/scrapers.config.json";
        $this->scraper_config = file_get_contents(base_path() . $config_file_path);
    }

    public function initialize_store_scraper(string $store)
    {
//        work on throwing actual exception
//        if(!property_exists($this->scraper_config_file, $store)) throw PropertyNo

        $store_scraper_config = $this->scraper_config->{$store};
        $this->store_scrapers->{$store} =  new Scraper(
            GoutteShopScraperAdapter::class,
            $store_scraper_config->baseURI,
            $store_scraper_config->searchSegment,
            $store_scraper_config->parentDOM,
            $store_scraper_config->extractables
        );
    }

    public function initialize_stores_scrapers(array $stores)
    {
        foreach ($stores as $store) $this->initialize_store_scraper($store);
    }

    public function set_preferences(object $preferences)
    {
        $this->stores = $preferences->store;
        $this->shopping_priorities = $preferences->shopping_priorities;
    }

    public function get(string $query, array $params)
    {
        if(!is_null($params['store'])) return $this->get_from_store($query, $params['store']);
        else if(!is_null($params['stores'])) return $this->get_from_stores($query, $params['stores']);
        else if(!is_null($params['shopping_priority'])) return $this->get_by_sp($query, $params['shopping_priority']);
        else if(!is_null($params['shopping_priorities'])) return $this->get_by_sps($query, $params['shopping_priorities']);
        else if(!is_null($params['preferences'])) return $this->get_using_preferences($query, $params['preferences']);
        else return $this->get_by_query($query);
    }

    protected function get_by_query(string $query, object $scrapers = null){
        $_scrapers = is_null($scrapers) ? $this->store_scrapers : $scrapers;
        $_results = [];
        foreach ($_scrapers as $store_name => $scraper){
            $_results[$store_name] = $scraper->search($query);
        }
        return $_results;
    }

    protected function get_from_store(string $query, string $store){
        $scrapers = new stdClass();
        $scrapers->{$store} = $this->store_scrapers->{$store};
        return $this->get_by_query($query, $scrapers);
    }

    protected function get_from_stores(string $query, array $stores){
        $scrapers = new stdClass();
        foreach ($stores as $store){
            $scrapers->{$store} = $this->store_scrapers->{$store};
        }
        return $this->get_by_query($query, $scrapers);
    }

    protected function sort_by_sp(array $result, array $sp){

    }
    protected function get_by_sp(string $query, string $shopping_priority){

    }

    protected function get_by_sps(string $query, array $shopping_priorities){

    }

    protected function get_using_preferences(string $query, array $preferences){

    }

//    protected function get_from_cache(string $query, array $store){
//
//    }
// Interact with cache efficiently
//    protected

}
