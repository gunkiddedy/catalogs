<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // protected $table = 'products';
    
    protected $fillable = [
                        'name', 'brand', 'price', 'description', 'category_id',
                        'subcategory_id', 'user_id', 'company_name', 'provinsi_id', 'kabupaten_id', 
                        'kecamatan_id', 'hs_code', 'sni', 'image_path'
                    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }

    // satu product mempunyai banyak image (one to many)
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    // accessor function
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function getBrandAttribute($value)
    {
        return ucfirst($value);
    }

    public function scopeWithFilters($query)
    {
        return $query->when(count(request()->input('category_items', [])), function ($query) {
                $query->whereIn('category_id', request()->input('category_items'));
            })
            ->when(count(request()->input('subcategory_items', [])), function ($query) {
                $query->whereIn('subcategory_id', request()->input('subcategory_items'));
            })
            ->when(count(request()->input('select_provinsi', [])), function ($query) {
                $query->whereIn('provinsi_id', request()->input('select_provinsi'));
            })
            ->when(count(request()->input('select_kabupaten', [])), function ($query) {
                $query->whereIn('kabupaten_id', request()->input('select_kabupaten'));
            });
    }    
}
