<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $increment = 100;
        $productName = $this->faker->sentence(1);

        return [
            'product_code' => 'SKU' . 'SKL' . 'LNP' . $increment++,
            'product_name' => $productName,
            'slug' => Str::slug($productName),
            'price' => $this->faker->numberBetween(100, 999) * 1000,
            'currency' => $this->faker->randomElement(['IDR', 'USD', 'SGD']),
            'discount' => $this->faker->randomElement([0, 10, 20, 30]),
            'dimension' => $this->faker->randomElement(['10 cm X 10 cm', '15 cm X 15 cm', '20 cm X 20 cm']),
            'unit' => $this->faker->randomElement(['PCS', 'PACK']),
            'description' => $this->faker->paragraph(),
        ];
    }
}
