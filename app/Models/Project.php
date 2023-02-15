<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Pishran\LaravelPersianSlug\HasPersianSlug;
use Spatie\Sluggable\SlugOptions;

class Project extends Model
{
    use HasFactory;

    protected $hidden = ['is_active','charity'];

    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'image_head',
        'pishraft',
        'type_pay',
        'slug',
    ];

    use HasPersianSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }


}
