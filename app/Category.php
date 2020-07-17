<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // accessor function
    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }

    public function categories()
    {
        return $this->hasMany(SubCategory::class);
    }
}
