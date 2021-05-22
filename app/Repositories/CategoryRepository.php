<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends ResourceRepository
{

    /**
     * CategoryRepository constructor.
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->model = $category;
    }



}