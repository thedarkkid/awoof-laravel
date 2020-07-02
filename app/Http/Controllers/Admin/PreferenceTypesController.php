<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PreferenceType\StorePreferenceTypeRequest;
use App\Http\Requests\PreferenceType\UpdatePreferenceTypeRequest;
use App\Models\PreferenceType;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PreferenceTypesController extends Controller
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
     * Show the preference listing page.
     *
     * @return Renderable
     */
    public function index()
    {
        $preference_types = PreferenceType::paginate(15);

        return view("admin.preferences.types.home")
            ->with('preference_types', $preference_types);
    }


    /**
     * Show the form for creating a new preference.
     *
     * @return Factory|Response|View
     */
    public function create()
    {
        return view("admin.preferences.types.create");
    }


    /**
     * Store a new preference to storage.
     *
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function store(StorePreferenceTypeRequest $request)
    {
        // get validated array from request, return error if need be
        $validated = $request->validated();

        // format data
        $validated['name'] = strtolower($validated['name']);

        // create preference type object and store it
        $preference_type = new PreferenceType($validated);
        $preference_type->save();

        session()->flash('status', ['success', 'New preference type '.$preference_type->name.' has been created']);
        return redirect()->back();
    }


    /**
     * Update the specified preference to storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse|Response
     */
    public function update(UpdatePreferenceTypeRequest $request, $id)
    {
        // validate stuff
        $validated = $request->validated();

        $validated['name'] = strtolower($validated['name']);

        try{
            // get preference type
            $preference_type = PreferenceType::findOrFail($id);
            $old_name = $preference_type->name;
        }catch (ModelNotFoundException $e){
            // show failure
            session()->flash('status', ['error', "Preference type with id ".$id." was not found"]);
            return redirect()->back();

        }

        if($preference_type->update($validated)){
            session()->flash('status', ['success', "Preference type \"".$old_name."\" updated to \"".$preference_type->name."\"  successfully"]);
            return redirect()->back();
        }

        session()->flash('status', ['error', "unknown error occured"]);
        return redirect()->back();
    }


    /**
     * Remove the specified preference from storage.
     *
     * @param  int  $id
     * @return RedirectResponse|Response
     */
    public function destroy($id)
    {
        try{
            // get preference type
            $preference_type = PreferenceType::findOrFail($id);

        }catch (ModelNotFoundException $e){
            // show failure
            session()->flash('status', ['error', "Preference type with id ".$id." was not found"]);
            return redirect()->back();

        }

        // delete preference
        if($preference_type->delete()){
            // show success
            session()->flash('status', ['success', "Preference type \"".$preference_type->name."\" has been deleted successfully"]);
            return redirect()->back();
        }

        session()->flash('status', ['error', "unknown error occured"]);
        return redirect()->back();

    }
}
