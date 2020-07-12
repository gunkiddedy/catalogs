<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $fillable = ['kabupaten_id', 'name'];

    // inverse from kabupaten
    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }

    // kecamatan mempunyai banyak user (one to many)
    public function users()
    {
        return $this->hasMany(User::class);
    }

}
