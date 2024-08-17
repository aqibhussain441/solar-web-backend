<?php

use App\Models\ProductType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_type_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ProductType::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable(); // Optional: for section details
            $table->integer('order')->default(0); // Optional: for sorting sections
            $table->boolean('is_active')->default(true); //
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_type_sections');
    }
};
