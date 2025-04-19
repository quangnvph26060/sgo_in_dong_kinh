<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'sgo_contacts';
    protected $fillable = [
        'name',
        'title',
        'address',
        'website',
        'company',
        'phone',
        'email',
        'map',
        'logo',
        'icon',
        'fanpage',
        'description',
        'introduce',
        'company_logo',
        'youtube',
        'seo_title',
        'seo_description',
        'copyright',
        'working_time',
        'header_top',
        'commits',
        'supports'
    ];

    protected $casts = [
        'commits' => 'array',
        'supports' => 'array',
    ];
}
