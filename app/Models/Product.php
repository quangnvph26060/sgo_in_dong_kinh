<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = 'sgo_products';
    protected $fillable = [
        'name',
        'short_name',
        'slug',
        'price',
        'sku',
        'status',
        'description',
        'short_description',
        'is_top',
        'is_advertisement',
        'is_tet_edition',
        'advertisement_image',
        'view_count',
        'sale_price',
        'start_date',
        'end_date',
        'title_seo',
        'description_seo',
        'image',
        'category_id'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if ($model->isDirty('name')) $model->slug = Str::slug($model->name);
        });

        static::updating(function ($model) {
            if ($model->isDirty('name')) $model->slug = Str::slug($model->name);
        });
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
