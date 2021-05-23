<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->jobTitle;

        return [
            'title' => $title,
            "slug"  => $this->faker->slug,
            "description" => $this->faker->realText(),
            'price' => $this->faker->numberBetween(200, 99999),
            'qty_available' => $this->faker->numberBetween(1, 100),
            'online'    => $this->faker->boolean,
            'category_id' => Category::inRandomOrder()->pluck('id')->first(),
            'user_id'   => User::inRandomOrder()->pluck('id')->first()
        ];
    }
}
