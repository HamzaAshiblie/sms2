<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function client()
    {
        $this->belongsTo('App\Client');
    }
    public function order_items()
    {
        $this->hasMany('App\Order_item');
    }
}
