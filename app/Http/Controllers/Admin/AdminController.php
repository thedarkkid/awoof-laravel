<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //Todo implement users CRUD on admin panel
    //Todo implement user preferences crud on admin panel
    //Todo implement pagination properly on admin
    //Todo add users page on admin panel

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware("admin");
    }

    /**
     * Show the admin dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view("admin.home");
    }
}
