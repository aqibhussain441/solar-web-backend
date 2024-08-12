<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;


class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $image_path = config('constants.product.subcategory.image_path');
        $thumbnail_path = config('constants.product.subcategory.thumbnail_path');

        // Ensure the directory exists
        if (!File::exists($image_path)) {
            File::makeDirectory($thumbnail_path, 0755, true);
        }

        $thumbnailDirectory = storage_path('app/public/' . $thumbnail_path);

        // Ensure the directory exists
        if (!File::exists($thumbnailDirectory)) {
            File::makeDirectory($thumbnailDirectory, 0755, true);
        }

        ProductCategory::factory()->count(2)->create();
    }
}
