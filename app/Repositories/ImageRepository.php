<?php


namespace App\Repositories;


use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ImageRepository extends ResourceRepository
{

    /*
     * File name attribute.
     * */
    protected const FILE = 'code';

    /*
     * Disk name.
     * */
    protected const DISK = 'public';

    /*
     * Directory name.
     * */
    protected const LINK = 'products';

    /**
     * ImageRepository constructor.
     * @param Image $image
     */
    public function __construct(Image $image)
    {
        $this->model = $image;
    }

    /**
     * @param $model
     * @param array $inputs
     * @return Model
     */
    public function update(Model $model, array $inputs): Model
    {

        $inputs[static::FILE] = $this->updateFile($inputs[static::FILE], $model[static::FILE], static::LINK.DIRECTORY_SEPARATOR.$inputs['DIR'], static::DISK);

        return $model->update($inputs);
    }

    public function store(array $inputs)
    {
        $product = $inputs['product'];
        unset($inputs['product']);
        $category = Str::slug($product->category->name);
        $link = self::LINK.DIRECTORY_SEPARATOR.$category.DIRECTORY_SEPARATOR.now()->format('y/m/d').DIRECTORY_SEPARATOR."$product->slug";
        $inputs[static::FILE] = $inputs[static::FILE]->store($link, static::DISK);
        return $this->model->create($inputs);

    }

}