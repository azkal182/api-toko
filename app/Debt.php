<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    //

    public function member()
    {
        return $this->belongsTo(Customer::class);
    }
}
