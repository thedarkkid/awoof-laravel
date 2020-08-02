<?php

use App\Models\Preference;
use App\Models\PreferenceType;
use Illuminate\Database\Seeder;

class SetUpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $store_pt = (new PreferenceType(["name" => "stores"]))->save();
        $sp_pt = (new PreferenceType(["name" => "shopping_priorities"]))->save();

        $jumia =  ( new Preference(["name" => "jumia", "preference_type_id" => $store_pt->id]))->save();
        $slot =  ( new Preference(["name" => "slot", "preference_type_id" => $store_pt->id]))->save();
        $kara =  ( new Preference(["name" => "kara", "preference_type_id" => $store_pt->id]))->save();

        $rating =  ( new Preference(["name" => "rating", "preference_type_id" => $sp_pt->id]))->save();
        $price =  ( new Preference(["name" => "price", "preference_type_id" => $sp_pt->id]))->save();
    }
}
