<?php

namespace App\Http\Controllers\Category;

use App\Category;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class CategoryTransactionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        //
        $transactions= $category->products()
        // some categories dint have transactions so we use whereHas
        ->whereHas('transactions')
        ->with('transactions')
        ->get()
        ->pluck('transactions')
        ->unique('id')
        ->values();
        return $this->showAll($transactions);
    }

}
