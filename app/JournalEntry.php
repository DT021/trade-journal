<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
    /**
     * Get the user who owns this entry
     */
    public function user() {
        return $this->belongsTo('App\User');
    }
}
