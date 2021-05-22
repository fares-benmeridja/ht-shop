<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = collect(
            ['article', 'collec']
        )->random();

        $name == 'article' ? $name.= $this->faker->numberBetween(1, 3) : $name.= $this->faker->numberBetween(1, 9);

        $content = public_path("img".DIRECTORY_SEPARATOR."$name.jpg");
        $path = Storage::disk('public')->putFile('products', $content);
        return [
            'code' => $path,
            "product_id" => Product::inRandomOrder()->pluck('id')->first()
        ];
    }
}
