<?php

namespace App;

use App\Customer;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function customer()
    {
        return $this->belongsTo( Customer::class );
    }
}
