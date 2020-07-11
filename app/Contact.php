<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'company_name', 
        'company_phone', 
        'company_email',
        'company_address',
        'company_country',
        'company_whatsapp',
        'company_telegram',
        'company_facebook',
        'company_instagram',
        'company_twitter',
    ];
}
