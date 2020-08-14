<?php

namespace App\Models;

use App\Helpers\Scraper;
use App\Helpers\ScraperAdapters\GoutteShopScraperAdapter;
use App\Helpers\UtilityHelper;
use App\Interfaces\IScraperModel;
use App\Traits\DisplayHelpers;
use Illuminate\Support\Facades\Cache;
use stdClass;

/**
 * Class Store
 * @package App\Models
 */
class Store implements IScraperModel
{
    use DisplayHelpers;
    /**
     * @var string
     */
    protected string $config_file_path = "/scrapers.config.json";
    /**
     * @var mixed|object
     */
    protected object $scraper_config;
    /**
     * @var stdClass
     */
    protected stdClass $store_scrapers;
    /**
     * @var array|mixed
     */
    protected array $stores = ["jumia", "kara", "slot"];
    /**
     * @var array|mixed
     */
    protected array $shopping_priorities = ["price" => 1, "rating" => 2];

    /**
     * @var array
     */
    public static array $default_order = ["price" => "asc", "rating" => "desc"];
    private  array $order = ["price" => "asc", "rating" => "desc"];
    /**
     * @var int
     */
    public static int $storage_time = 86400;
    /**
     * Store constructor.
     * @param string|null $config_file_path
     * @param array|null $preferences
     */
    public function __construct(string $config_file_path = null, array $preferences = null)
    {
        // get the file path of the scrapers config file.
        if(!is_null($config_file_path)) $this->config_file_path = $config_file_path;

        // get the content of the file and convert it to an object.
        $scraper_file_content = file_get_contents(base_path().$this->config_file_path);
        $this->scraper_config = json_decode($scraper_file_content);
        $this->store_scrapers = new stdClass();
        // set default preferences
        if(!is_null($preferences)){
            if(key_exists("stores", $preferences) && !is_null($preferences["stores"])) $this->stores = $preferences["stores"];
            if(key_exists("shopping_priorities", $preferences) && !is_null($preferences["shopping_priorities"])) $this->shopping_priorities = $preferences["shopping_priorities"];
            if(key_exists("order", $preferences) && !is_null($preferences["order"])  && !empty($preferences["order"])) $this->order = $preferences["order"];
        }

        // set up individual scraper objects for all the stores based on the contents of the config file.
        $this->initialize_stores_scrapers($this->stores);
    }

    /**
     * @param string $config_file_path
     */
    public function set_config_file_path(string $config_file_path)
    {
        // get the file path of the scrapers config file.
        $this->config_file_path = !is_null($config_file_path) ? base_path().$config_file_path: base_path()."/scrapers.config.json";

        // get the content of the file and convert it to an object.
        $scraper_file_content = file_get_contents(base_path().$config_file_path);
        $this->scraper_config = json_decode($scraper_file_content);
    }

    /**
     * @param string $store
     */
    public function initialize_store_scraper(string $store)
    {
        // check if the scraper config for the store exists in the config object.
        if(!property_exists($this->scraper_config, $store)) abort(500, "Store config not found, maybe check scraper config file?");

        // get scraper configuration for store from the scraper config object.
        $store_scraper_config = $this->scraper_config->{$store};

        // initialise scraper object with store scraper config data.
        $scraper_Adapter = new GoutteShopScraperAdapter(
            $store_scraper_config->baseURI,  $store_scraper_config->searchSegment,
            $store_scraper_config->parentDOM,  $store_scraper_config->extractables);

        $this->store_scrapers->{$store} =  new Scraper($scraper_Adapter);
    }

    /**
     * @param array $stores
     */
    public function initialize_stores_scrapers(array $stores)
    {
        // initialize multiple scraper objects for multiple stores.
        foreach ($stores as $store) $this->initialize_store_scraper($store);
    }

    /**
     * @param object $preferences
     */
    public function set_preferences(object $preferences)
    {
        // set the list of all the stores to be scraped which is also the name of the config objects of those stores.
        $this->stores = $preferences->stores;

        // initialize multiple scraper objects for the multiple stores.
        foreach ($this->stores as $store) $this->initialize_store_scraper($store);

        // set the shopping priorities for the stores to be scraped.
        $this->shopping_priorities = $preferences->shopping_priorities;
    }

    /**
     * @param string $query
     * @param array|null $params
     * @return array
     */
    public function get(string $query, array $params=null)
    {
        // check passed parameters and call respective function.
        if(is_null($params)) return $this->get_by_default_sps($query);
        if(!is_null($params['store'])) return $this->get_from_store($query, $params['store']);
        else if(!is_null($params['stores'])) return $this->get_from_stores($query, $params['stores']);
        else if(!is_null($params['shopping_priority'])) return $this->get_by_sp($query, $params['shopping_priority']);
        else if(!is_null($params['shopping_priorities'])) return $this->get_by_sps($query, $params['shopping_priorities']);
        else if(!is_null($params['preferences'])) return $this->get_using_preferences($query, $params['preferences']);
        else return $this->get_by_default_sps($query);
    }

    /**
     * @param string $query
     * @param array $preferences
     * @return array
     */
    public function get_using_preferences(string $query, array $preferences){
        // generate scraper objects to be used.
        $scrapers = new stdClass();
        foreach ($preferences["stores"] as $store){
            $scrapers->{$store} = $this->store_scrapers->{$store};
        }

        // get scraped data using query and scraper objects.
        $query_result= $this->get_by_query($query, $scrapers);

        // return result array sorted by shopping priorities.
        return $this->sort_by_sps($query_result, $preferences["shopping_priorities"]);
    }

    /**
     * @param string $query
     * @param object|null $scrapers
     * @return array
     */
    protected function get_by_query(string $query, object $scrapers = null){
        // decide to use passed scraper or object scraper.
        $_scrapers = is_null($scrapers) ? $this->store_scrapers : $scrapers;

        // get scraped data using scrapers.
        $_results = [];
        $_conc_stores = "";

        // check if exists in cache then get from cache, if else, scrape.
        if(Cache::has($query)){
            $cache_data = Cache::get($query);
            foreach ($_scrapers as $store_name => $scraper){
                if(key_exists($store_name, $cache_data)) $_results[$store_name] = $cache_data[$store_name];
                else $_results[$store_name] = $_scrapers->{$store_name}->search($query);
                $_conc_stores .= $store_name;
            }
        }else{
            foreach ($_scrapers as $store_name => $scraper){
                $_results[$store_name] = $scraper->search($query);
                $_conc_stores .= $store_name;
            }
            Cache::put($query, $_results, Store::$storage_time);
        }


        // merge resulting array and shuffle results.
        if(Cache::has($query.$_conc_stores)){
            $_results = Cache::get($query.$_conc_stores);
            shuffle($_results);
        }else{
            $_results = UtilityHelper::merge_arrays(array_values($_results));
            shuffle($_results);
            Cache::put($query.$_conc_stores, $_results, Store::$storage_time);
        }

        // return scraped data.
        return $_results;
    }

    /**
     * @param string $query
     * @param object|null $scrapers
     * @return array
     */
    protected function get_by_default_sps(string $query, object $scrapers = null){
        // get scraped data by query.
        $query_result= $this->get_by_query($query, $scrapers);

        // sort data by default shopping priorities.
        return $this->sort_by_sps($query_result, $this->shopping_priorities);
    }

    /**
     * @param string $query
     * @param string $store
     * @return array
     */
    protected function get_from_store(string $query, string $store){
        // create scraper object from store name.
        $scrapers = new stdClass();
        $scrapers->{$store} = $this->store_scrapers->{$store};

        // returned scraped data using scraper object.
        return $this->get_by_default_sps($query, $scrapers);
    }

    /**
     * @param string $query
     * @param array $stores
     * @return array
     */
    protected function get_from_stores(string $query, array $stores){
        // create scraper object from store names.
        $scrapers = new stdClass();
        foreach ($stores as $store){
            $scrapers->{$store} = $this->store_scrapers->{$store};
        }

        // returned scraped data using scraper objects.
        return $this->get_by_default_sps($query, $scrapers);
    }

    /**
     * @param array $result
     * @param array $sps
     * @param array|null $order
     * @return array
     */
    public function sort_by_sps(array $result, array $sps, array $order = null){
        // get default order
        if(is_null($order)) $order = $this->order;

        // get shopping priorities.
        $_sps = $sps;

        // sort them so the one with the highest priority(smallest index) comes first.
        asort($_sps);

        // reverse sorted array so lowest priority comes first.
        $sp_reversed = array_reverse($_sps);

//        $this->prettyDump($sp_reversed);
        // loop through result array and sort by priority with lowest priority sorts happening first.
        foreach ($sp_reversed as $sp_key => $sp_value){
             $result = UtilityHelper::sort_multi_array_by_key($result, $sp_key, $order[$sp_key]);
        }

        // return result array sorted by shopping priorities.
        return $result;
    }

    /**
     * @param string $query
     * @param string $shopping_priority
     * @return array
     */
    protected function get_by_sp(string $query, string $shopping_priority){
        // return scraped data using query.
        $result = $this->get_by_query($query);

        // return result array after it has been sorted by shopping priority.
        return $this->sort_by_sps($result, [$shopping_priority => 1]);
    }

    /**
     * @param string $query
     * @param array $shopping_priorities
     * @return array
     */
    protected function get_by_sps(string $query, array $shopping_priorities){
        // return scraped data using query.
        $result = $this->get_by_query($query);

        // return result array after it has been sorted by shopping priorities.
        return $this->sort_by_sps($result, $shopping_priorities);
    }
}

