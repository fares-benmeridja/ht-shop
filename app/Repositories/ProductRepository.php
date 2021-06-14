<?php


namespace App\Repositories;


use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductRepository extends ResourceRepository
{
    /**
     * @var ImageRepository
     */
    private $imageRepository;

    /**
     * ProductRepository constructor.
     * @param Product $product
     * @param ImageRepository $imageRepository
     */
    public function __construct(Product $product, ImageRepository $imageRepository)
    {
        $this->model = $product;
        $this->imageRepository = $imageRepository;
    }

    public function destroy(Model $model)
    {
        $model->load('images');

        $images = [];
        foreach ($model->images as $image)
            $images[] = $image->code;

        $this->deleteFile($images);
        return $model->delete();
    }

    public function update(Model $model, array $inputs)
    {

        $inputs['slug'] = Str::slug($model->created_at->format('myhi').'-'.$inputs['title']);

        parent::update($model ,$inputs);

        if (isset($inputs['images'])){
            $model->load('images');
            foreach($model->images as $image){
                $this->imageRepository->destroy($image);
            }

            foreach ($inputs['images'] as $image){
                $this->imageRepository->store(['product_id' => $model->id, 'product' => $model, "code" => $image]);
            }

        }
    }

    public function online(Model $model, array $input)
    {
        return $model->update($input);
    }

    public function store(array $inputs)
    {

        $inputs['slug'] = Str::slug(now()->format('myhi').'-'.$inputs['title']);

        $inputs['user_id'] = Auth::user()->id;

        $product = parent::store($inputs);

        foreach ($inputs['images'] as $image){
            $this->imageRepository->store(['product_id' => $product->id, 'product' => $product, "code" => $image]);
        }

        return $product;

    }
}