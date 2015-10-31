<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPrimer extends Model
{
    protected $table = 'products_primer';

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
