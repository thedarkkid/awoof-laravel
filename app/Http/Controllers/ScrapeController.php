<?php

namespace App\Http\Controllers;

use App\Traits\PreferencesHelper;
use App\Models\PreferenceType;
use App\Traits\DisplayHelpers;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class ScrapeController extends Controller
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

    protected function get_current_user_preferences(){
        return $this->get_user_preferences_by_id(Auth::id());
    }

    protected function get_user_preferences_by_id($id){
        // get list of user stores.
        $stores = $this->get_current_user_stores($this->store_pt_id);

        // get list of user shopping priorities.
        $shopping_priorities = $this->get_user_preferences($id, $this->shopping_priorities_pt_id);
        $sps = empty($shopping_priorities) ? null : $shopping_priorities;

        return["stores" => $stores, "shopping_priorities" => $sps];
    }
}
