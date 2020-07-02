<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Preference extends Model
{
    protected $table = 'preference';

    /**
     * return relation with the preference_type table
     * @return BelongsTo
     */
    public function preference_type(){
        return $this->belongsTo(PreferenceType::class);
    }

    /**
     * return relation with the user_preferences table
     * @return HasMany
     */
    public function user_preferences(){
        return $this->hasMany(UserPreference::class, 'preference_id');
    }
}
