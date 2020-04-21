<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use App\Http\Controllers\APiController;
use Illuminate\Http\Request;

class BuyerProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        //
        $products= $buyer->transactions()->with('product')
        ->get()
        // the pluck method will go inside the collection and optain an index we explicitly give it
        ->pluck('product');
        return $this->showAll($products);
    }

}
