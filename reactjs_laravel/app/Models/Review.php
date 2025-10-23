<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'approved', 'rating', 
    'product_id'];

    public function user()
    {
        // each review belongs to the user
        return $this->belongsTo(User::class);
    }
    public function product()
    {
        // each review belongs to the product
        return $this->belongsTo(Product::class);
    }
    public function getCreatedAtAttribute($value)
    {
        // each review belongs to the product
        return Carbon::parse($value)->diffForHumans();
    }
}
