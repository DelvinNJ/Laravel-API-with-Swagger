<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use App\Models\Collection;
use App\Models\CollectionProduct;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Product extends Model
{
    use HasFactory, SoftDeletes, HasSlug;

    protected $fillable = [
        'title', 'html_content', 'vendor', 'product_type', 'status'
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
        // return $this->hasMany(CollectionProduct::class, 'product_id', 'id');  
        // No need to specify product_id automatically identify when model name same as foreign key followed by "_id"    
    }
    public function collections(){
        return $this->belongsToMany(Collection::class, 'collection_products', 'product_id', 'collection_id');
    }
}