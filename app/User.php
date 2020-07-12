<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'tkdn', 
        'provinsi_id', 'kabupaten_id', 'kecamatan_id', 
        'address', 'nib', 'additional_info', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // user hanya memiliki satu provinsi (inverse from provinsi)
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    // user hanya memiliki satu kabupaten (inverse from kabupaten)
    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }

    // user hanya memiliki satu kecamatan (inverse from kecamatan)
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    // accessor function
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }
    
}
