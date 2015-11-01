<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\GroupsCategory
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $company_id
 * @property integer $order
 * @property boolean $enabled
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Company $company
 * @method static \Illuminate\Database\Query\Builder|\App\GroupsCategory whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GroupsCategory whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GroupsCategory whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GroupsCategory whereCompanyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GroupsCategory whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GroupsCategory whereEnabled($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GroupsCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GroupsCategory whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Category[] $categories
 */
class GroupsCategory extends Model
{
    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function categories()
    {
        return $this->hasMany('App\Category', 'group_category_id');
    }
}
