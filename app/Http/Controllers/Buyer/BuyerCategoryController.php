<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class BuyerCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        //
        $categories= $buyer->transactions()->with('product.categories')
        ->get()
        ->pluck('product.categories')
        // product is a collection cos its belongstomany reltionship with category and we need only one unique list of product
        // we use the collapse method to abtain the list of collection
        ->collapse()
        ->unique('id')
        ->values();
        return $this->showAll($categories);
    }

}
