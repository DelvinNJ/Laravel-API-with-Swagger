<?php

namespace Database\Factories;

use App\Models\Collection;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CollectionFactory extends Factory
{
    protected $model = Collection::class;

    public function definition(): array
    {
        $title = $this->faker->word;
        return [
            'title' => $title,
            'handle' => Str::slug($title),
            'html_content' => $this->faker->paragraph,
            'status' => $this->faker->boolean,
        ];
    }
}
