<?php

namespace Database\Factories;

use App\Models\ProductType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $image_path = config('constants.product.image_path');
        $thumbnail_path = config('constants.product.thumbnail_path');
        $image_width = config('constants.product.image_width');
        $thumbnail_width = config('constants.product.thumbnail_width');
        $image_height = config('constants.product.image_height');
        $thumbnail_height = config('constants.product.thumbnail_height');

        return [
            'name' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'dimensions' => $this->faker->randomFloat(2, 1, 100),
            'weight' => $this->faker->randomFloat(2, 1, 100),
            'main_image' => $image_path . $this->faker->image(
                dir: storage_path('app/public/' . $image_path),
                fullPath: false,
                category: 'products',
                format: 'jpg',
                width: $image_width,
                height: $image_height
            ),
            'main_thumbnail' => $thumbnail_path . $this->faker->image(
                dir: storage_path('app/public/' . $thumbnail_path),
                fullPath: false,
                category: 'products',
                format: 'jpg',
                width: $thumbnail_width,
                height: $thumbnail_height
            ),
            'product_sub_category_id' => \App\Models\ProductSubCategory::factory(),
            'product_type_id' => ProductType::factory(),
            'is_active' => $this->faker->boolean,
            'show_latest' => $this->faker->boolean,
            'description' => $this->faker->text,
        ];
    }
}
