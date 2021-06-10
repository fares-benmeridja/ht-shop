<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ModalConfigTable extends Component
{

    public $data;

    public string $search = "";

    public string $image = '';

    private $fields = ['id', 'title', 'slug', 'price', 'online', 'qty_available', 'category_id'];

    protected $queryString = [
        'search' => [ 'except' => '']
    ];

//    protected $listeners = [
//        'searchByTitleField'
//    ];


    public function chargePic(string $imagePath)
    {
        $this->image = $imagePath;
    }

    public function resetPic()
    {
        $this->reset('image');
    }

    public function render()
    {

        $products = $this->search === ''
            ? $this->data
            : Product::config()
            ->where('title', 'LIKE', "%$this->search%")
            ->withCategory()
            ->with('images')
            ->limit(200)
            ->get($this->fields);


//        $chunks = $products->chunkWhile(function ($value, $key, $chunk){
//            return $value->category->name === $chunk->last()->category->name;
//        });
//
//        $combine = collect([]);
//        foreach ($products as $p){
//            $combine->push($p->category->name);
//        }
//
//        $collection = $combine->unique()->combine($chunks);

        $products = collect($products)->recursive();
        return view('livewire.modal-config-table', [
//            'collection' => $collection,
            'image' => $this->image,
            'products' => $products,
            'count' => $products->count()
        ]);
    }
}
