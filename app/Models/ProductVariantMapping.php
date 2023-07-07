<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Variant;
class ProductVariantMapping extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'variant_id',
    ];
    public function variant(){
        return $this->belongsTo(Variant::class,'variant_id');
    }
    
}