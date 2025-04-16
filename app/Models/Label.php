<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'position'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_label_product');
    }
}
