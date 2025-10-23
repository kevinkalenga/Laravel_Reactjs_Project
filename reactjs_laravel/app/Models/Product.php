<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'slug', 'qty', 'price', 'desc', 
    'thumbnail', 'first_image', 'second_image', 'third_image', 'status'];

    public function colors()
    {
        // first relation color
        return $this->belongsToMany(Color::class);
    }
    public function sizes()
    {
          // second relation size
        
        return $this->belongsToMany(Size::class);
    }
    public function orders()
    {
          // third relation order
        return $this->belongsToMany(Order::class);
    }
    public function reviews()
    {
          // fourth relation review(each product wil have one or many reviews)
        return $this->hasMany(Review::class)->with('user')->where('approved', 1)->latest();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
