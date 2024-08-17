<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductCategory>
 */
class ProductCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->sentence;
        $image_path = config('constants.product.category.image_path');
        $thumbnail_path = config('constants.product.category.thumbnail_path');

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'is_active' => $this->faker->boolean(90),
            'image' => $image_path . $this->faker->image(
                dir: storage_path('app/public/' . $image_path),
                fullPath: false,
                category: 'products',
                format: 'jpg'
            ),
            'thumbnail' => $thumbnail_path . $this->faker->image(
                dir: storage_path('app/public/' . $thumbnail_path),
                fullPath: false,
                category: 'products',
                format: 'jpg',
                width: round(640 / 3),
                height: round(480 / 3)
            ),
            'details' => $this->faker->paragraph,
            'add_in_footer' => $this->faker->boolean(50),
        ];
    }
}
