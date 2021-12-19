<?php

namespace App\Http\Controllers\API\Transaction;

use App\Http\Controllers\Controller;
use App\Interfaces\TransactionInterface;
use App\Http\Requests\TransactionRequest;

class TransactionController extends Controller
{

    protected $transactionInterface;

    /**
     * Create a new constructor for this controller
     */
    public function __construct(TransactionInterface $transactionInterface)
    {
        $this->transactionInterface = $transactionInterface;
    }

    public function create(TransactionRequest $request){
        return $this->transactionInterface->createTransaction( $request );
    }
}
