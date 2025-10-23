<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = ['name'];

    public function products()
    {
        // each product belongs to many colors and each color belongs to many products
        return $this->belongsToMany(Product::class);
    }
}
