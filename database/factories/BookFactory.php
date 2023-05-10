<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $prefix = [
            'As crônicas de ',
            'Biografia de ',
            'A incrível história de ',
            'Entrevista com ',
        ];
        $index = rand(0, 3);
        $title = $prefix[$index] . $this->faker->name;

        return [
            'title'       => $title,
            'page_amount' => $this->faker->numberBetween(200, 500),
            'cover_image' => $this->faker->imageUrl('195', '278', 'book'),
            'description' => $this->faker->text(255),
        ];
    }
}
