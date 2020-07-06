<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';

    protected $fillable = ['name', 'product_id', 'image_path'];

    public function post()
    {
        return $this->belongsTo('App\Product');
    }
}
