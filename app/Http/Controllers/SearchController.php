<?php

namespace App\Http\Controllers;


use App\Http\Requests\Search\SearchQueryRequest;;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class SearchController extends ScrapeController
{
    // todo use computeExtractables to create sortable properties
    // todo add store image to individual result
    // todo fix image loading problem
    // todo make sure preference/preference types deletion also deletes relations
    // todo fix admin/user login crossover
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
        $query = $request->validated()["query"];

        $default_store = new Store();

        $preferences = $this->get_current_user_preferences();
        $user_store = new Store(null, $preferences);

        $auth = Auth::check();

        $result = ($auth)? $user_store->get($query): $default_store->get($query);

        $pagination = $this->get_pagination($request, $result);
        return view('search.result')->with(["products" => $pagination, "query" => $query]);
    }


}
