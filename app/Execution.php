<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Execution extends Model
{
    /**
     * Mutator to format the expiration column from broker CSVs correctly.
     */
    public function setExpirationAttribute($value)
    {
        $this->attributes['expiration'] = date("Y-m-d", strtotime($value));
    }
}
