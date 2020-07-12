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

    // public function author()
    // {
    //     return $this->belongsTo('App\User');
    // }

    // satu product mempunyai banyak image (one to many)
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    
}
