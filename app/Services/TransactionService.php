<?php

namespace App\Services;

use App\Models\Transaction;
use App\Repositories\TransactionRepository;

class TransactionService
{
    protected $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function getAllTransactions()
    {
        return cache()->remember('transactions:all', 60 * 60, function () {
            return $this->transactionRepository->getAll();
        });
    }

    public function getTransactionById(int $id): Transaction
    {
        return cache()->remember("transaction:{$id}", 60 * 60, function () use ($id) {
            return $this->transactionRepository->find($id);
        });
    }

    public function createTransaction(array $data): Transaction
    {
        cache()->forget('transactions:all');

        return $this->transactionRepository->create($data);
    }

    public function updateTransaction(array $data, int $id): Transaction
    {
        $transactionById = $this->transactionRepository->find($id);

        cache()->forget("transaction:{$id}");
        cache()->forget('transactions:all');

        return $this->transactionRepository->update($transactionById, $data);
    }

    public function deleteTransaction(int $id): ?bool
    {
        $result = $this->transactionRepository->delete($id);

        if ($result) {
            cache()->forget("transaction:{$id}");
            cache()->forget('transactions:all');
        }

        return $result;
    }
}
