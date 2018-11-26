<?php
namespace App\Repositories;

use App\User;

class UserRepository extends AbstractRepository
{

    function __construct(User $model)
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
            ->select('users.*');

        return $query->orderBy('users.id', 'asc');
    }

} 