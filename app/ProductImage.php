<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    // protected $table = 'product_images';

    protected $fillable = ['name', 'product_id', 'image_path'];

    // inverse from product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
