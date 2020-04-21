<?php

namespace App\Providers;

use App\Product;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // this is to listen to the event
        Product::updated(function($product){
            if($product->quantity == 0 && $product->isAvailable()){
                $product->status = Product::UNAVAILABLE_PRODUCT;
                $product->save();
            }
        });
    }
}
