<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\ApiController;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index($id)
    // {
    //     //
    //     $transactionForCategory= Transaction::findOrFail($id)->product->categories;
    //     return response()->json(['data'=>$transactionForCategory], 200);
    // }

    public function index(Transaction $transaction)
    {
        // from their models
        $categories= $transaction->product->categories;
        return $this->showAll($categories);
    }
}
