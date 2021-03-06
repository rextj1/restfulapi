<?php

namespace App;

use App\Scopes\SellerScope;

class Seller extends User
{
     // boot method
     protected static function boot(){
        parent::boot();
        static::addGlobalScope(new SellerScope);
    }
    //
    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
