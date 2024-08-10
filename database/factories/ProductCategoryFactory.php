<?php

namespace Database\Factories;

use Illuminate\Support\Str;
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
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'is_active' => $this->faker->boolean(90),
            'image' => $this->faker->image(dir: storage_path('app/public/product_categories'), category: 'products', fullPath: false, format: 'jpg'),
            'details' => $this->faker->paragraph,
            'add_in_footer' => $this->faker->boolean(50),
        ];
    }
}
