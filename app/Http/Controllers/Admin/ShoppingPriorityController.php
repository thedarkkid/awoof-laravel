<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ShoppingPriorityController extends Controller
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
     * Show the shopping priorities listing page.
     *
     * @return Renderable
     */
    public function index()
    {
        return view("admin.preferences.shopping_priorities.home");
    }

    /**
     * Show the form for creating a new shopping priority.
     *
     * @return Factory|Response|View
     */
    public function create()
    {
        return view("admin.preferences.shopping_priorities.create");
    }


    /**
     * Store a newly shopping priority to storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Show the form for editing the shopping priority
     *
     * @param  int  $id
     * @return Factory|Response|View
     */
    public function edit($id)
    {
        return view("admin.preferences.shopping_priorities.edit");
    }

    /**
     * Update the specified shopping priority to storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified shopping priority from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
