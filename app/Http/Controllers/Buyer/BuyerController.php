<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use Illuminate\Http\Request;
// Apicontroller now becomes the new base controller instead of the normal controller
use App\Http\Controllers\ApiController;

class BuyerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // the buyer with transaction is a buyer in the user's table
        $buyers= Buyer::has('transactions')->get();
        return $this->showAll($buyers);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Buyer $buyer)
    {
        //
        // $buyer= Buyer::has('transactions')->findOrFail($id);
        return $this->showOne($buyer);
    }
}
