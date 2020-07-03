<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Preference;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PreferencesController extends Controller
{
    //Todo implement users CRUD admin panel
    //Todo implement user preferences crud admin panel
    //Todo implement pagination properly admin
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
     * Show the preference listing page.
     *
     * @return Renderable
     */
    public function index()
    {
        $preferences = Preference::all();
        return view("admin.preferences.base.home")
            ->with('preferences', $preferences);
    }


    /**
     * Show the form for creating a new preference.
     *
     * @return Factory|Response|View
     */
    public function create()
    {
        return view("admin.preferences.base.create");
    }


    /**
     * Store a new preference to storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Show the form for editing the preference
     *
     * @param  int  $id
     * @return Factory|Response|View
     */
    public function edit($id)
    {
        return view("admin.preferences.base.edit");
    }


    /**
     * Update the specified preference to storage.
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
     * Remove the specified preference from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
