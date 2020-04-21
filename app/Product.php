<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $dates= ['deleted_at'];
    // the model that ha
    // the foreign key is the model that belongsto
    // the product belongsto one seller
    const AVAILABLE_PRODUCT = 'available';
    const UNAVAILABLE_PRODUCT = 'unavailable';
    protected $fillable=[
        'name',
        'description',
        'quantity',
        'status',
        'image',
        'seller_id'
    ]; 
    
    protected $hidden= [
        'pivot'
    ];

    // relationships with others
    public function isAvailable(){
        return $this->status == Product::AVAILABLE_PRODUCT;
    }

    public function seller()
    {
        return $this->belongsTo('App\Seller');
    }

    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }
    
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

}
