<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function order_items()
    {
        return  $this->hasMany('App\Order_item');
    }
    public function category()
    {
        return  $this->belongsTo('App\Category');
    }

    public function product_updates()
    {
        return  $this->hasMany('App\Product_update');
    }
    public function purchases()
    {
        return  $this->hasMany('App\Purchase');
    }
}
