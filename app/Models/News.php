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
        'slug',
        'posted_at',
        'article',
        'is_favorite',
        'view',
        'created_at',
        'updated_at',
        'seo_title',
        'seo_description',
        'status',
        'summary',
        'featured_image'
    ];

    protected $casts = [
        'posted_at' => 'date'
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
            $builder->where('status', 'published')->where('posted_at', '<=', now());
        });

        static::creating(function ($model) {
            $model->slug = Str::slug($model->subject);
            $model->seo_title = $model->subject;
        });

        static::updating(function ($model) {
            if ($model->isDirty('subject')) {
                $model->slug = Str::slug($model->subject);
            }
            $model->seo_title = $model->subject;
        });

        static::deleting(function ($model) {
            deleteImage($model->featured_image);
        });
    }
}
