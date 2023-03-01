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

    const PATH = "products";

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
//        $categories = collect([
//            'Laptops',
//            "Printers & Scanners",
//            "Desktop Computer parts",
//            "Computers Accessories",
//            "Network",
//            "Desktop PCs",
//            "Laptop parts",
//            "External storage",
//            "Processor",
//            "Graphic card",
//            "RAM",
//            "SSD",
//            "HDD",
//            "Motherboard",
//            "Power supply unit",
//            "Boitier",
//            "Network card"
//        ]);


//            $category = $categories->random();

//            $categories->forget($categories->search($category));

        $file = [
            'Laptops'                   => 'laptops',
            'Printers & Scanners'       => "printers",
            "Desktop Computer parts"    => "desktop-parts",
            "Computers Accessories"     => "computers-accessories",
            "Network"                   => "network",
            "Desktop PCs"               => "desktop-pcs",
            "Laptop parts"              => "laptop-parts",
            "External storage"          => "external-storage",
            "Processor"                 => "processor",
            "Graphic card"              => "graphic-card",
            "RAM"                       => "ram",
            "SSD"                       => "ssd",
            "HDD"                       => "hdd",
            "Motherboard"               => "motherboard",
            "Power supply unit"         => "psu",
            "Boitier"                   => "boitier",
            "Network card"              => "network-card"
        ];

        $product = Product::withCount('images')
            ->having('images_count', '<', '4')
            ->first();

        $category = $product->category->name;
        $name = $file[$category].DIRECTORY_SEPARATOR.$this->faker->numberBetween(1,4);

        $content = __DIR__.DIRECTORY_SEPARATOR.self::PATH.DIRECTORY_SEPARATOR."$name.jpg";

        $format = 'y/m/d';
//            $product = Product::whereHas('category', function ($q) use ($category) {
//                return $q->where('name', $category);
//            })->withCount('images')->having('images_count', '<=', '4')->get(['id', 'slug'])->limit(1);


        $path = Storage::disk('public')->putFile(self::PATH.DIRECTORY_SEPARATOR.$file[$category].DIRECTORY_SEPARATOR.now()->format($format).DIRECTORY_SEPARATOR."$product->slug", $content);

        return [
            'code' => $path,
            "product_id" => $product->id
        ];
    }
}
