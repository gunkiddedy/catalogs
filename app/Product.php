<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // protected $table = 'products';
    
    protected $fillable = [
                        'name', 'brand', 'price', 'description', 'category_id',
                        'subcategory_id', 'user_id', 'hs_code', 'sni'
                    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // satu product mempunyai banyak image (one to many)
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    // accessor function
    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }

    public function getBrandAttribute($value)
    {
        return strtoupper($value);
    }
    
}
