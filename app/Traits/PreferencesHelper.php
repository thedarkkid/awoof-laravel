<?php


namespace App\Traits;


use App\Models\Preference;
use App\Models\UserPreference;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait PreferencesHelper
{

    public function get_user_preferences($user_id, $pt_id){
        $user_preferences = [];

        try{
            Preference::where('preference_type_id', $pt_id)->firstOrFail();
            $preferences = Preference::where('preference_type_id', $pt_id)->get();

            foreach ($preferences as $preference){
                $u_preference = UserPreference::where(['preference_id' => $preference->id, 'user_id' => $user_id])->firstOrFail();
                $user_preferences[$preference->name] = $u_preference->priority;
            }
        }catch (ModelNotFoundException $e){ return $user_preferences;}

        asort($user_preferences);
        return $user_preferences;
    }

    public function get_stores_from_preferences(array $preferences){
        if(is_null($preferences)) return null;
        $stores = [];
        foreach ($preferences as $preference_name => $preference_value){
            $stores[] = $preference_name;
        }
        return $stores;
    }
}
