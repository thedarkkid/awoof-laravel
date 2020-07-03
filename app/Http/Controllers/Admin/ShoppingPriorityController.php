<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Preference\StorePreferenceRequest;
use App\Http\Requests\Preference\UpdatePreferenceRequest;
use App\Models\Preference;
use App\Models\PreferenceType;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ShoppingPriorityController extends Controller
{
    public $preference_type_id;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // implement authentication;
        $this->middleware("admin");

        // get id of shopping controller
        try{
            $preference_type =  PreferenceType::where('name', 'shopping priorities')->firstOrFail();
            $this->preference_type_id = $preference_type->id;
        }catch (ModelNotFoundException $e){
            $this->preference_type_id = null;
        }
    }

    /**
     * Show the shopping priorities listing page.
     *
     * @return Renderable|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        if(is_null($this->preference_type_id) ){
            session()->flash('_status', ['danger', 'Preference shopping priority does not exist']);
            return redirect()->route('admin.home');
        }

        $preferences = Preference::where('preference_type_id', $this->preference_type_id)
            ->orderBy('id', 'DESC')
            ->paginate(7);

        return view("admin.preferences.shopping_priorities")
            ->with('preferences', $preferences)
            ->with('preference_type_id', $this->preference_type_id);
    }

    /**
     * Store a newly shopping priority to storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|Response
     */
    public function store(StorePreferenceRequest $request)
    {
        // get validated array from request, return error if need be
        $validated = $request->validated();

        // format data
        $validated['name'] = strtolower($validated['name']);

        // create store object and store it
        $store = new Preference($validated);
        $store->save();

        session()->flash('_status', ['success', 'New shopping priority '.$store->name.' has been created']);
        return redirect()->back();
    }


    /**
     * Update the specified shopping priority to storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|Response
     */
    public function update(UpdatePreferenceRequest $request, $id)
    {
        // get validation error
        $validated = $request->validated();

        $validated['name'] = strtolower($validated['name']);

        try{
            // get preference type
            $store = Preference::findOrFail($id);
            $old_name = $store->name;
        }catch (ModelNotFoundException $e){
            // show failure
            session()->flash('_status', ['error', "Shopping priority with id ".$id." was not found"]);
            return redirect()->back();

        }

        if($store->update($validated)){
            session()->flash('_status', ['success', "Shopping priority \"".$old_name."\" updated to \"".$store->name."\"  successfully"]);
            return redirect()->back();
        }

        session()->flash('_status', ['error', "unknown error occured"]);
        return redirect()->back();
    }

    /**
     * Remove the specified shopping priority from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|Response
     */
    public function destroy($id)
    {
        try{
            // get preference type
            $preference = Preference::findOrFail($id);

        }catch (ModelNotFoundException $e){
            // show failure
            session()->flash('_status', ['error', "Shopping Priority  with id ".$id." was not found"]);
            return redirect()->back();

        }

        // delete preference
        if($preference->delete()){
            // show success
            session()->flash('_status', ['success', "Shopping Priority  \"".$preference->name."\" has been deleted successfully"]);
            return redirect()->back();
        }

        session()->flash('_status', ['error', "unknown error occured"]);
        return redirect()->back();
    }
}
