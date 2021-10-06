<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Validate_company extends Model
{
    protected $fillable = [
        'name',
        /* 'logo', */
        'address',
        'facebook',
        'linkedin',
        'twitter',
        'instagram',
        'category',
        'association',
        'description',
        'website',
        'mail',
        'tel',
        'activity',
        'fund_raising',
        'employees',
        'recrutement',
        'women',
        'ca',
        'postcode',
        /* 'coordinate_x',
        'coordinate_y', */
        
    ];
}
