<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product_category() : BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function product_subcategory() : BelongsTo
    {
        return $this->belongsTo(ProductSubcategory::class);
    }

    public function multiImage() : HasMany
    {
        return $this->hasMany(MultiImage::class);
    }
}
