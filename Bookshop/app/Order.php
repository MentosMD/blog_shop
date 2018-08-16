<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'OrderTotal', 'OrderDate',
        'OrderQuantity', 'cart'
    ];
    protected $order = 'orders';
}
