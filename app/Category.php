<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    //
    use SoftDeletes;
    protected $dates= ['deleted_at'];
    protected $fillable=['name','description']; 

    // Pivot table. inver relationshion
    // category has many to many relationshion with product table
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    protected $hidden= [
        'pivot'
    ];
}
