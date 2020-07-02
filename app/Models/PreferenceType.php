<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PreferenceType extends Model
{
    protected $table = 'preference_types';
    protected $guarded = [];

    /**
     * return relation with the preferences table
     * @return HasMany
     */
    public function preferences(){
        return $this->hasMany(Preference::class, 'preference_type_id');
    }

}
