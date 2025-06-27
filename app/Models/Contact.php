<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'sgo_contacts';
    protected $fillable = [
        'title',
        'address',
        'website',
        'company',
        'phone',
        'hotline',
        'email',
        'tax_code',
        'map',
        'logo',
        'icon',
        'banner',
        'fanpage',
        'description',
        'introduce',
        'seo_title',
        'seo_description',
        'copyright',
        'working_time',
        'commits',
        'head_script',
        'body_script',
        'footer_script'
    ];

    protected $casts = [
        'commits' => 'array',
    ];
}
