<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class PcConfig extends Component
{

    private $compatibles = [];

    public $panier = [];

    private $fields = ['id', 'title', 'slug', 'price', 'online', 'qty_available', 'category_id'];

    public function compatibles($id)
    {

        $this->panier[] = Product::findOrFail($id, $this->fields);

        $product = Product::findOrFail($id, $this->fields)->compatibles;
        $product->load('category');

        $chunks = $product->chunkWhile(function ($value, $key, $chunk){
            return $value->category->name === $chunk->last()->category->name;
        });

        $combine = collect([]);
        foreach ($product as $p){
            $combine->push($p->category->name);
        }

        $this->dispatchBrowserEvent('compatiblesConfig');

        return $combine->combine($chunks);
    }

    private function all()
    {
        $products = Product:: config()
            ->withCategory()
            ->with('images')
            ->limit(200)
            ->get($this->fields);

        $chunks = $products->chunkWhile(function ($value, $key, $chunk){
            return $value->category->name === $chunk->last()->category->name;
        });

        $combine = collect([]);
        foreach ($products as $p){
            $combine->push($p->category->name);
        }

        return $combine->unique()->combine($chunks);
    }

    public function render()
    {

        $collection = $this->compatibles === []
            ? $this->all()
            : $this->compatibles;

        return view('livewire.pc-config', [
            'collection' => $collection,
        ]);

    }
}
