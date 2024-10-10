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
        return $this->transactionRepository->getAll();
    }

    public function getTransactionById(int $id): Transaction
    {
        return $this->transactionRepository->find($id);
    }

    public function createTransaction(array $data): Transaction
    {
        return $this->transactionRepository->create($data);
    }

    public function updateTransaction(array $data, int $id): Transaction
    {
        $transactionById = $this->transactionRepository->find($id);

        return $this->transactionRepository->update($transactionById, $data);
    }

    public function deleteTransaction(int $id): ?bool
    {
        return $this->transactionRepository->delete($id);
    }
}
