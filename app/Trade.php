<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    /**
     * Get the user who owns this trade.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the executions associated with this trade.
     */
    public function executions()
    {
        return $this->hasMany('App\Exectuion');
    }
}
