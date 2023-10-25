<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Brand::class)->constrained('brands');
            $table->foreignIdFor(\App\Models\ProductCategory::class)->constrained('product_categories');
            $table->foreignIdFor(\App\Models\ProductSubcategory::class)->constrained('product_subcategories');
            $table->string('name');
            $table->string('slug');
            $table->string('code');
            $table->string('quantity');
            $table->string('tags')->nullable();
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->string('price');
            $table->string('discount')->nullable();
            $table->text('short_description');
            $table->text('long_description');
            $table->string('thumbnail');
            $table->foreignIdFor(\App\Models\User::class)->constrained('users');
            $table->integer('hot_deals')->nullable();
            $table->integer('featured')->nullable();
            $table->integer('special_offer')->nullable();
            $table->integer('special_deals')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
