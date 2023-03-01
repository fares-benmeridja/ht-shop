<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Arr;
use Livewire\Component;

class PcConfig extends Component
{

    public $selectedProducts = [];

    public int $compatible = 0;

    public $cart = [];

    public int $amount = 0;

    public $combined;

    private $fields = ['id', 'title', 'slug', 'price', 'online', 'qty_available', 'category_id'];

    public function setCompatible(int $id)
    {
        $this->compatible = $id;
        $product = Product::with(['category', 'images'])->findOrFail($id, $this->fields);

        $this->selectedProducts[$product->category->name] = $id;

        $this->cart[$id] =[
                'image'     => $product->first_image,
                'category'  => $product->category->name,
                'cat_slug'  => $product->category->slug,
                'product_slug' => $product->slug,
                'title'     => $product->title,
                "qty_dispo" => $product->qty_available,
                "product_id" => $product->id,
                'price'     => $product->price
        ];

        $this->amount();

//        $this->selectedProducts->push(Product::with('category')->findOrFail($id, $this->fields));
        $this->dispatchBrowserEvent('closeModal');
    }

    private function compatibles()
    {
        $product = Product::findOrFail($this->compatible, $this->fields);

        $compatibles = $product->compatibles;
        $compatibles->load('category');

        $product->load('category');
        $compatibles->prepend($product);

        $sortedByCategory = $compatibles->sortBy('category_id')->groupBy('category_id');

//        $unionCollection = $this->combined->values()->union($this->getCombined($sortedByCategory)->unique()->values());

        // J'ai les categories filtré sans la catégorie du produit selectioné
//        dd($this->combined, $sortedByCategory);
        $result = $this->combined->combine($sortedByCategory);

        foreach ($result as $key => $value)
            foreach ($this->selectedProducts as $k => $selectedProduct)
                if ($k === $key){
                    unset($value[0]);
                    $value->put(0, Product::with(['category', 'images'])->findOrFail($selectedProduct, $this->fields));
                    break;
                }

        return $result;
    }

    public function all()
    {
        $this->reset('compatible');

        $products = Product::config()
            ->withCategory()
            ->with('images')
            ->orderBy('category_id')
            ->get($this->fields);

        $sortedByCategory = $products->sortBy('category_id')->groupBy('category_id');

        $this->combined = $this->getCombined($sortedByCategory)->unique();

        return $this->combined->combine($sortedByCategory);
    }

    public function unsetProduct($key)
    {
        if (Arr::has($this->selectedProducts, $key)){
            unset($this->cart[$this->selectedProducts[$key]]);
            unset($this->selectedProducts[$key]);
            $this->amount();
        }
    }

    public function amount()
    {
        $this->amount = 0;
        foreach ($this->cart as $product)
            $this->amount += $product['price'];
    }

    public function cart()
    {
        foreach ($this->cart as $key => $product)
        {
            $price = $product['price'];
            unset($product['price']);
            Cart::add($key, $product['title'], 1, $price, $product);
        }

        return redirect()->route('cart.index');
    }

    public function render()
    {
        return view('livewire.pc-config', [
            'collection' => $this->selectedProducts === []
                ? $this->all()
                : $this->compatibles()
        ]);
    }

    private function getCombined($sorted)
    {
        $combine = collect([]);
        foreach ($sorted as $chunk){
            foreach ($chunk as $p)
                $combine->push($p->category->name);
        }

        return $combine;
    }
}
