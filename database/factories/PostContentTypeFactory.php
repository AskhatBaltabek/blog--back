<?php

namespace Database\Factories;

use App\Models\PostContentType;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostContentTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostContentType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(10),
        ];
    }
}
