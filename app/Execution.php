<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Execution extends Model
{
    /**
     * Get the trade that this execution belongs to.
     */
    public function trade()
    {
        return $this->belongsTo(Trade::class);
    }
    
    /**
     * Mutator to format the expiration column from broker CSVs correctly.
     */
    public function setExpirationAttribute($value)
    {
        $this->attributes['expiration'] = date("Y-m-d", strtotime($value));
    }
}
