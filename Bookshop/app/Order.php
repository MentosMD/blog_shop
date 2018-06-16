<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'OrderTotal', 'OrderDate',
        'OrderQuantity', 'name',
        'email', 'phone',
        'address', 'city',
        'cart'
    ];
    protected $order = 'orders';
}
