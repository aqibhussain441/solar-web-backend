<?php

use App\Models\ProductCategory;
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
        Schema::create('product_sub_categories', function (Blueprint $table) {
            // Category name, active/inactive, image, category details
            $table->id();
            $table->foreignIdFor(ProductCategory::class)->constrained();
            $table->string('name');
            $table->string('slug')->unique(); // Optional: for SEO-friendly URLs
            $table->boolean('is_active')->default(true);
            $table->string('image')->nullable();
            $table->string('thumbnail')->nullable();
            $table->longText('details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sub_categories');
    }
};
