<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = 'subcategories';

    protected $fillable = ['name', 'category_id'];

    public function products()
    {
        return $this->hasMany(Product::class, 'subcategory_id');
    }

    // accessor function
    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
