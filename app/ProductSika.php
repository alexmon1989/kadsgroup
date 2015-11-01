<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ProductSika
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $package
 * @property string $package_list
 * @property string $characteristics
 * @property string $using_area
 * @property string $photo
 * @property integer $category_id
 * @property string $tech_cart_file
 * @property boolean $enabled
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Category $category
 * @method static \Illuminate\Database\Query\Builder|\App\ProductSika whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductSika whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductSika whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductSika wherePackage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductSika wherePackageList($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductSika whereCharacteristics($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductSika whereUsingArea($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductSika wherePhoto($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductSika whereCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductSika whereTechCartFile($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductSika whereEnabled($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductSika whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductSika whereUpdatedAt($value)
 */
class ProductSika extends Model
{
    protected $table = 'products_sika';

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
