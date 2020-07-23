<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    protected $fillable = ['provinsi_id', 'name'];

    // inverse realationship (kabupaten hanya memiliki satu propinsi)
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    // kabupaten memiliki banyak kecataman
    public function kecamatans()
    {
        return $this->hasMany(Kecamatan::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // kabupaten memiliki banyak users
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // accessor function
    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }
}
