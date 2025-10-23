<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = ['name'];

    public function products()
    {
        // each size belongs to many products and each product have many size
        return $this->belongsToMany(Product::class);
    }
}
