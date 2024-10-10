<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use App\Services\TransactionService;

class TransactionController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $this->authorize('viewAny', Transaction::class);
        $usersArray = $this->transactionService->getAllTransactions();

        return TransactionResource::collection($usersArray);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \App\Http\Resources\TransactionResource
     */
    public function show($id)
    {
        $this->authorize('view', Transaction::class);
        $user = $this->transactionService->getTransactionById($id);

        return TransactionResource::make($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateTransactionRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateTransactionRequest$request)
    {
        $this->authorize('create', Transaction::class);
        $user = $this->transactionService->createTransaction($request->validated());

        return response()->json(TransactionResource::make($user), 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransactionRequest  $request
     * @param  int  $id
     *
     * @return \App\Http\Resources\TransactionResource
     */
    public function update(UpdateTransactionRequest $request, int $id)
    {
        $this->authorize('update', Transaction::class);
        $updatedUser = $this->transactionService->updateTransaction($request->validated(), $id);

        return TransactionResource::make($updatedUser);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $this->authorize('delete', Transaction::class);
        $isTransactionDelete = $this->transactionService->deleteTransaction($id);

        return $isTransactionDelete ?
            response()->json(null, 204) :
            response()->json(['error' => 'The resource you are trying to delete is no longer available.'], 410);
    }
}
