<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
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
