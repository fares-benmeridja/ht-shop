<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class PcConfig extends Component
{

    public int $compatibles = 0;
    public int $listenerID = -1;

    public $cart = [];

    private $fields = ['id', 'title', 'slug', 'price', 'online', 'qty_available', 'category_id'];

    public function setCompatibles(int $id, int $listenerID)
    {
        $this->compatibles = $id;
        $this->listenerID = $listenerID;
    }

    private function compatibles()
    {
        $product = Product::findOrFail($this->compatibles, $this->fields);

        $compatibles = $product->compatibles;
        $compatibles->load('category');

        $product->load('category');
        $compatibles->prepend($product);

        $chunks = $compatibles->chunkWhile(function ($value, $key, $chunk){
            return $value->category->name === $chunk->last()->category->name;
        });

        $combine = collect([]);
        foreach ($compatibles as $p){
            $combine->push($p->category->name);
        }

        return $combine->combine($chunks);
    }

    private function all()
    {
        $this->reset('compatibles');

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
        return view('livewire.pc-config', [
            'collection' => $this->compatibles === 0
                ? $this->all()
                : $this->compatibles()
        ]);
    }
}
