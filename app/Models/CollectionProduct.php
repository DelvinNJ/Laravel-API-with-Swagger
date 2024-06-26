<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CollectionProduct extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['product_id', 'collection_id'];

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
