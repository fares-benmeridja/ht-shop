<?php

namespace Database\Factories;

use App\Models\Category;
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

    const PATH = "products";

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $category = collect(
            [
                'Laptops',
                "Printers & Scanners",
                "Desktop Computer parts",
                "Computers Accessories",
                "Network",
                "Desktop PCs",
                "Laptop parts",
                "External storage"
            ]
        )->random();

        $file = [
            'Laptops' => 'laptops',
            'Printers & Scanners' => "printers",
            "Desktop Computer parts" => "desktop-parts",
            "Computers Accessories"  => "computers-accessories",
            "Network" => "network",
            "Desktop PCs" => "desktop-pcs",
            "Laptop parts" => "laptop-parts",
            "External storage" => "external-storage"
        ];

        $name = $file[$category].DIRECTORY_SEPARATOR.$this->faker->numberBetween(1,4);

        $content = __DIR__.DIRECTORY_SEPARATOR.self::PATH.DIRECTORY_SEPARATOR."$name.jpg";
        $format = 'y/m/d';
        $product = Product::whereHas('category', fn($q) => $q->where('name', $category))->has('images', '<=', '4')->inRandomOrder()->first(['id', 'slug']);
        $path = Storage::disk('public')->putFile(self::PATH.DIRECTORY_SEPARATOR.now()->format($format).DIRECTORY_SEPARATOR."$product->slug", $content);

        return [
            'code' => $path,
            "product_id" => $product->id
        ];
    }
}
