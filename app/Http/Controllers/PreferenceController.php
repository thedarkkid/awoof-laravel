<?php

namespace App\Http\Controllers;

use App\Helpers\ErrorHelper;
use App\Traits\PreferencesHelper;
use App\Models\Preference;
use App\Models\PreferenceType;
use App\Models\UserPreference;
use App\Traits\DisplayHelpers;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PreferenceController extends Controller
{
    use DisplayHelpers, PreferencesHelper;

    protected $store_pt_id = null;
    protected $shopping_priorities_pt_id = null;

    public function __construct()
    {
        try {
            $this->store_pt_id = PreferenceType::where('name', 'stores')->firstOrFail()->id;
            $this->shopping_priorities_pt_id = PreferenceType::where('name', 'shopping priorities')->firstOrFail()->id;
        }catch (ModelNotFoundException $e){}
    }

    public function stores_preferences(){
        if(is_null($this->store_pt_id)){
            return view('preferences.stores')
                ->with(['pt-error' => ErrorHelper::pt_not_created("Store")]);
        }

        $current_stores = $this->get_user_preferences(Auth::id(), $this->store_pt_id);
        $stores = Preference::where('preference_type_id', $this->store_pt_id)->get();

        return view('preferences.stores')->with(['stores' => $stores, "current_stores" => $current_stores]);
    }



    public function shopping_priorities_preferences(){
        if(is_null($this->shopping_priorities_pt_id)){
            return view('preferences.shopping_priorities')
                ->with(['pt_error' => ErrorHelper::pt_not_created("Shopping Priorities")]);
        }

        $current_sp = $this->get_user_preferences(Auth::id(), $this->shopping_priorities_pt_id);
        $sp = Preference::where('preference_type_id', $this->shopping_priorities_pt_id)->get();

        return view('preferences.shopping_priorities')->with(["priorities" => $sp, "current_sp" => $current_sp ]);
    }

    public function create_or_update_stores_preferences(Request $request){
        $user_id = $request->input('_user');
        $stores = Preference::where('preference_type_id', $this->store_pt_id)->get();

        foreach ($stores as $store){
            try{
                $user_preference = UserPreference::where(['preference_id' => $store->id, 'user_id' => $user_id])
                    ->firstOrFail();
                $user_preference->priority = ($request->has($store->name) && $request->input($store->name) == 'on') ? 1 : 0;
                $user_preference->save();
            }catch (ModelNotFoundException $e){
                $user_preference = new UserPreference();
                $user_preference->preference_id = $store->id;
                $user_preference->priority = $request->has($store->name) ? 1 : 0;
                $user_preference->user_id = $user_id;
                $user_preference->save();
            }
        }

        session()->flash('_status', ['success', "Store preferences updated successfully"]);
        return redirect()->back();
    }
    public function create_or_update_shopping_priorities_preferences(Request $request){
        $user_id = $request->input('_user');
        $shopping_priorities = Preference::where('preference_type_id', $this->shopping_priorities_pt_id)->get();

        foreach ($shopping_priorities as $shopping_priority){
            try{
                $user_preference = UserPreference::where(['preference_id' => $shopping_priority->id, 'user_id' => $user_id])
                    ->firstOrFail();
                $user_preference->priority = $request->input($shopping_priority->name);
                $user_preference->save();
            }catch (ModelNotFoundException $e){
                $user_preference = new UserPreference();
                $user_preference->preference_id = $shopping_priority->id;
                $user_preference->priority = $request->input($shopping_priority->name);
                $user_preference->user_id = $user_id;
                $user_preference->save();
            }
        }

        session()->flash('_status', ['success', "Shopping priorities preferences updated successfully"]);
        return redirect()->back();
    }



}
