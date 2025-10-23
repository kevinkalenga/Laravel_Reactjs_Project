<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
     protected $fillable = ['name', 'discount', 'valid_until'];

    public function setNameAttribute($value)
    {
        // convert the coupon name to uppercase
        $this->attributes['name'] = Str::upper($value);
    }
    public function checkIfValid()
    {
        // check if coupon is valid
        if($this->valid_until > Carbon::now()) {
            return true; 
        } else {
            return false;
        }
    }
}
