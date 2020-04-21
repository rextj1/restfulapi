<?php

namespace App;

use App\Scopes\BuyerScope;


class Buyer extends User
{
    // boot method
    protected static function boot(){
        parent::boot();
        static::addGlobalScope(new BuyerScope);
    }
    // buyer has ne to many relationshion
    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }
}
