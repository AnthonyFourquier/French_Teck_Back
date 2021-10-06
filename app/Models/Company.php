<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
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
        'coordinate_x',
        'coordinate_y',
        'postcode'
        /* 'logo', */
    ];
}
