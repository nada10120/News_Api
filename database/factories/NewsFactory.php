<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

        'title' => $this->faker->sentence(3, 10), // Generate a sentence with 3 to 10 words
        'description' => $this->faker->paragraph(1, true), // Generate a single paragraph with no trailing newline
        'body' => $this->faker->paragraphs(5, true), // Generate 5 paragraphs with no trailing newline
        'img' => $this->faker->imageUrl(640, 480, 'news', true), // Generate an image URL with a random news category
        'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'), // Generate a random date and time between -1 year and now
        ];
    }
}
