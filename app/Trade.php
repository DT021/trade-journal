<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    /**
    * Get the user who owns this trade.
    */
   public function user() {
       return $this->belongsTo('App\User');
   }

   /**
    * Mutator to format the expiration column from broker CSVs correctly.
    */
    public function setExpirationAttribute($value) {
        $this->attributes['expiration'] = date("Y-m-d", strtotime($value));
    }
}
