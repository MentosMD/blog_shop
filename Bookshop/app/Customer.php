<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
       'id', 'name', 'email', 'phone', 'address', 'city'
    ];

    protected $table = "order_customer";
}
