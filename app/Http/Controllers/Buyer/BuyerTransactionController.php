<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class BuyerTransactionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        // transaction by a specified buyer(id). all transactions made by a specific buyer
        // $buyerTransaction= Buyer::findOrFail($id)->transactions;
        $transactions= $buyer->transactions; 
        return $this->showAll($transactions);

    }

}
