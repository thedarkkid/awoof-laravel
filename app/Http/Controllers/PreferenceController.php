<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreferenceController extends Controller
{
    public function store_preference(){
        return view('preferences.store');
    }

    public function shopping_priorities_preference(){
        return view('preferences.shopping_priorities');
    }
}
