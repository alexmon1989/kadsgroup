<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ProductSfs
 *
 * @property integer $id
 * @property string $title
 * @property integer $category_id
 * @property string $file_name
 * @property boolean $enabled
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Category $category
 * @method static \Illuminate\Database\Query\Builder|\App\ProductSfs whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductSfs whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductSfs whereCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductSfs whereFileName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductSfs whereEnabled($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductSfs whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductSfs whereUpdatedAt($value)
 */
class ProductSfs extends Model
{
    protected $table = 'products_sfs';

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
