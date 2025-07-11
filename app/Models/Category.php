<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'sgo_categories';
    protected $fillable = [
        'name',
        'slug',
        'image',
        'banner',
        'description',
        'title_seo',
        'description_seo',
        'type',
        'status'
    ];

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

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function scopeActive($query)
    {
        return $query->where([
            'status' => 1,
            'type' => 'products'
        ]);
    }

    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }
}
