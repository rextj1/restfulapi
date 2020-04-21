<?php

namespace App\Scopes;

use App\Scopes\SellerScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class SellerScope implements Scope
{
    // implicit binding
    public function apply(Builder $builder, Model $model)
    {
        $builder->has('products');
    }
}
