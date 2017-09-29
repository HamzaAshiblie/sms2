<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_item extends Model
{
    public function order()
    {
        $this->belongsTo('App\Order');
    }
}
