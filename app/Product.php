<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function order_items()
    {
        return  $this->hasMany('App\Order_item');
    }
}
