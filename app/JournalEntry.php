<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
    /**
     * Get the user who owns this entry
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the trades associated with this journal entry
     */
    public function trades()
    {
        return $this->hasMany(Trade::class);
    }
}
