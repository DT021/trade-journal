<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    /**
    * Get the user who owns this trade
    */
   public function user() {
       return $this->belongsTo('App\User');
   }

   /**
    * 
    */
}
