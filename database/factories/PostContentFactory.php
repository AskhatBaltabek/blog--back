<?php

namespace Database\Factories;

use App\Models\PostContent;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostContentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostContent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_id' => $this->faker->numberBetween(1,50),
            'post_content_type_id' => $this->faker->numberBetween(1,2),
            'title' => $this->faker->text(10),
            'content' => $this->faker->paragraph(25),
        ];
    }
}
