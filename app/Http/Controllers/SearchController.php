<?php

namespace App\Http\Controllers;


use App\Http\Requests\Search\SearchQueryRequest;;
use Illuminate\Http\Request;

class SearchController extends ScrapeController
{
    // todo implement model for API data
    // todo implement cache system to store results
    // todo add store image to individual result
    // todo fix admin/user login crossover
    // todo fix image loading problem
    // todo make sure preference/preference types deletion also deletes relations
    // todo work on shopping priorities so it does not reset each time a new sp is added.

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        return view('search.home');
    }

    public function result(){
        return view('search.result');
    }

    public function single_product(){
        return view('search.single_product');
    }

    public function get_search_results(SearchQueryRequest $request){
        // display scraper data
        $query = $request->validated()["query"];
        $result = $this->search_and_extract($query);

        $pagination = $this->get_pagination($request, $result);
        return view('search.result')->with(["products" => $pagination, "query" => $query]);
    }

}
