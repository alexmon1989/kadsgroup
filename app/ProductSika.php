<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSika extends Model
{
    protected $table = 'products_sika';

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
