<?php

use App\Models\ProductTypeSection;
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
        Schema::create('product_type_section_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ProductTypeSection::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('type')->default('text');
            $table->json('options')->nullable(); // For dropdown, radio, checkbox
            $table->boolean('is_required')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0); // For sorting attributes within sections
            $table->string('default_value')->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_type_section_attributes');
    }
};
