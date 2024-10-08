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
        $image_path = config('constants.product.category.image_path');
        $thumbnail_path = config('constants.product.category.thumbnail_path');

        // Ensure the directories exist
        $this->ensureDirectoryExists(storage_path('app/public/' . $image_path));
        $this->ensureDirectoryExists(storage_path('app/public/' . $thumbnail_path));

        ProductCategory::factory()->count(2)->create();
    }

    /**
     * Ensure that a directory exists.
     *
     * @param string $directory
     * @return void
     */
    private function ensureDirectoryExists(string $directory)
    {
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }
    }
}
