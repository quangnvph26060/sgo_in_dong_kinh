<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;

    protected $table = 'sgo_news';
    protected $fillable = [
        'category_id',
        'subject',
        'short_name',
        'slug',
        'posted_at',
        'article',
        'is_favorite',
        'view',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'status',
        'summary',
        'featured_image',
        'seo_score'
    ];

    protected $casts = [
        'posted_at' => 'date',
        'is_favorite' => 'boolean',
        'seo_keywords' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'news_tags');
    }

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope('published', function ($builder) {
            $builder->where('status', 1)->where('posted_at', '<=', now()->toDateString());
        });

        static::creating(function ($model) {
            $model->slug = Str::slug($model->subject);
        });

        static::updating(function ($model) {
            if ($model->isDirty('subject')) {
                $model->slug = Str::slug($model->subject);
            }
        });

        static::deleting(function ($model) {
            deleteImage($model->featured_image);
        });
    }
}
