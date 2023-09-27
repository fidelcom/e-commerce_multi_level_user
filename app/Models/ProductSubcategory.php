<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductSubcategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product_category() : BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
