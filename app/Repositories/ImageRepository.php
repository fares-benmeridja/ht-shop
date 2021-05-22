<?php


namespace App\Repositories;


use App\Models\Image;
use Illuminate\Database\Eloquent\Model;

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

}