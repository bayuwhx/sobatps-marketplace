<?php

namespace Database\Factories;

use Carbon\Carbon;
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
        return [
            'title' => $this->faker->sentence(mt_rand(1, 3)),
            'slug' => $this->faker->slug(),
            'excerpt' => $this->faker->paragraph(),
            // 'description' => '<p>' . implode('</p><p>', $this->faker->paragraphs(mt_rand(3, 5))) . '</p>',
            'description' => collect($this->faker->paragraphs(mt_rand(3, 5)))
                ->map(fn($d) => "<p>$d</p>")
                ->implode(''),
            'source' => $this->faker->paragraph(),
            'function' => $this->faker->paragraph(),
            'price' => $this->faker->numberBetween(10000, 200000),
            'stock' => $this->faker->numberBetween(10, 200),
            'user_id' => 1,
            'category_id' => mt_rand(1, 2),
            'created_at' => Carbon::now(),
        ];
    }
}
