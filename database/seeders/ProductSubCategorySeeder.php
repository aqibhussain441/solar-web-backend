<?php

namespace Database\Seeders;

use App\Models\ProductSubCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProductSubCategorySeeder extends Seeder
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

        if (!$image_path || !$thumbnail_path) {
            // Log an error or handle the case where paths are not defined
            \Log::error('Image path or thumbnail path not defined in config.');
            return;
        }

        $imageDirectory = storage_path('app/public/' . $image_path);
        $thumbnailDirectory = storage_path('app/public/' . $thumbnail_path);

        // Ensure the directories exist
        $this->ensureDirectoryExists($imageDirectory);
        $this->ensureDirectoryExists($thumbnailDirectory);

        // Create the product subcategories
        ProductSubCategory::factory()->count(2)->create();
    }

    private function ensureDirectoryExists($directory)
    {
        if (!File::exists($directory)) {
            try {
                File::makeDirectory($directory, 0755, true);
            } catch (\Exception $e) {
                // Log the error or handle the exception
                \Log::error('Failed to create directory: ' . $directory . ' Error: ' . $e->getMessage());
            }
        }
    }
}
