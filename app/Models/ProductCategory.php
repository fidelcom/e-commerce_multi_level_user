<?php

namespace App\Models;

use App\Http\Controllers\Backend\ProductCategoryController;
use App\Http\Controllers\Backend\ProductSubcategoryController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product_subcategory() : HasMany
    {
        return  $this->hasMany(ProductSubcategory::class);
    }

    public function product() : HasMany
    {
        return $this->hasMany(Product::class);
    }
}
