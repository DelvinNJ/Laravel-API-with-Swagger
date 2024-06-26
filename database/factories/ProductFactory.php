<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class ProductFactory extends Factory
{
    protected $model = Product::class;          // define which model is related to this factory

    public function definition(): array
    {
        $title = $this->faker->word;
        return [
            'title' => $title,
            'handle' => Str::slug($title),
            'html_content' => $this->faker->paragraph,
            'vendor' => $this->faker->company,
            'product_type' => $this->faker->word,
            'status' => $this->faker->boolean,
        ];
    }
}