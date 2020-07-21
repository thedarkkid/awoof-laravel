<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPreference extends Model
{
    protected $table = 'user_preferences';
    protected $guarded = [];

    /**
     * return relation with preference table
     * @return BelongsTo
     */
    public function preference(){
        return $this->belongsTo(Preference::class, 'preference_id');
    }

    /**
     * return relation with user table
     * @return BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
