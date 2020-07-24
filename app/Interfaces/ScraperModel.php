<?php


namespace App\Interfaces;


interface ScraperModel
{
    public function __construct(string $config_file_path = null, array $stores = null);
    public function set_config_file_path(string $config_file_path);
    public function initialize_store_scraper(string $store);
    public function initialize_stores_scrapers(array $stores);
    public function set_preferences(object $preferences);
    public function get(string $query, array $params); // params = [string $store = null, array $stores = null, string $shopping_priority = null, array $shopping_priorities = null, array $preferences = null]
}
