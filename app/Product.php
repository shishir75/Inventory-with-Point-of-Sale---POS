<?php

namespace App;

use App\Category;
use App\Supplier;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo( Category::class );
    }

    public function supplier()
    {
        return $this->belongsTo( Supplier::class );
    }
}
