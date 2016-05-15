<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'username',
        'phone',
        'email',
        'company',
        'comment',
        'product_title',
        'status',
    ];
}
