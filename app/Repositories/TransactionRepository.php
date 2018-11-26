<?php
namespace App\Repositories;

use App\Transaction;

class TransactionRepository extends AbstractRepository
{

    function __construct(Transaction $model)
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
            ->select('transactions.*');

        return $query->orderBy('transactions.id', 'asc');
    }

} 