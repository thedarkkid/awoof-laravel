<?php


namespace App\Exceptions;


use Exception;

class StoreNotFoundException extends Exception
{
    protected $message = "Store config not found, maybe check scraper config file?";

    /**
     * @return string
     * @noinspection PhpHierarchyChecksInspection
     */
    final public function getMessage(): string
    {
        return $this->message;
    }

}
