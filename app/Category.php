<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Category
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $group_category_id
 * @property integer $parent_id
 * @property integer $order
 * @property boolean $enabled
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\GroupsCategory $group_category
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereGroupCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereEnabled($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereUpdatedAt($value)
 * @property-read \App\Category $parent_category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Category[] $child_categories
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ProductSika[] $products_sika
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ProductSfs[] $products_sfs
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ProductPrimer[] $products_primer
 */
class Category extends Model
{
    public function group_category()
    {
        return $this->belongsTo('App\GroupsCategory');
    }

    public function parent_category()
    {
        return $this->belongsTo('App\Category', 'parent_id');
    }

    public function child_categories()
    {
        return $this->hasMany('App\Category', 'parent_id');
    }

    public function products_sika()
    {
        return $this->hasMany('App\ProductSika');
    }

    public function products_sfs()
    {
        return $this->hasMany('App\ProductSfs');
    }

    public function products_primer()
    {
        return $this->hasMany('App\ProductPrimer');
    }
}
