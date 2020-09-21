<?php

namespace App;

use App\Employee;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    public function employee()
    {
        return $this->belongsTo( Employee::class );
    }
}
