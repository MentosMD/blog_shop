<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
       'id', 'OrderTotal', 'OrderDate',
        'OrderQuantity', 'cart', 'customer_id'
    ];
    protected $order = 'orders';
}
