<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductVariantMapping;
class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'image',
    ];
    public function variants()
    {
        return $this->hasMany(ProductVariantMapping::class,'product_id','id')->with('variant');
    }
    
}