<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class AdminController extends Controller
{
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
