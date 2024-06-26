<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use App\Models\Product;
use App\Models\CollectionProduct;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Collection extends Model
{
    use HasFactory, SoftDeletes, HasSlug;
    protected $fillable = [
        'title', 'html_content', 'status'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('handle');
    }

    public function collection_products()
    {
        return $this->hasMany(CollectionProduct::class);
    }
    public function products(){
        return $this->belongsToMany(Product::class,'collection_products', 'product_id', 'collection_id');
    }
}
