<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function orders()
{
    $this->hasMany('App\Order');
}
}
