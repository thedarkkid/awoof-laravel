<?php


namespace App\Helpers;


use App\Interfaces\IScraper;
use App\Interfaces\IScraperAdapter;

/**
 * Class Scraper
 * @package App\Helpers
 */
class Scraper implements IScraper
{
    /**
     * @var
     */
    protected $_adapter;

    /**
     * Scraper constructor.
     * @param IScraperAdapter $adapter
     */
    public function __construct(IScraperAdapter $adapter)
    {
            $this->_adapter = $adapter;
    }

    /**
     * @param IScraperAdapter $adapter
     */
    public function setAdapter(IScraperAdapter $adapter)
    {
        $this->_adapter = $adapter;
    }

    /**
     * @param IScraperAdapter|null $adapter
     * @return mixed
     */
    public function scrape(IScraperAdapter $adapter = null)
    {
        if($adapter) return $adapter->scrape();
        return $this->_adapter->scrape();
    }

    /**
     * @param string $search_query
     * @param IScraperAdapter|null $adapter
     * @return mixed
     */
    public function search(string $search_query, IScraperAdapter $adapter = null)
    {
        if($adapter) return $adapter->scrapeFromSearch($search_query);
        return $this->_adapter->scrapeFromSearch($search_query);
    }

}
