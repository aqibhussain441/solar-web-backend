<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $image_path = config('constants.product.image_path');
        $thumbnail_path = config('constants.product.thumbnail_path');

        // Ensure the directories exist
        $this->ensureDirectoryExists(storage_path('app/public/' . $image_path));
        $this->ensureDirectoryExists(storage_path('app/public/' . $thumbnail_path));

        Product::factory(5)->create();
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
