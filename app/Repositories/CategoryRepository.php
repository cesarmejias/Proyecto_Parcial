<?php
namespace App\Repositories;

use App\Category;

class CategoryRepository extends AbstractRepository
{

    function __construct(Category $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $filters
     *
     * @return mixed
     */
    public function search(array $filters = [])
    {
        $query = $this->model
            ->distinct()
            ->select('categories.*');

        return $query->orderBy('categories.id', 'asc');
    }

} 