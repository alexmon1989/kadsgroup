<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Company
 *
 * @property integer $id
 * @property string $title
 * @property string $short_title
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Gallery[] $galleries
 * @method static \Illuminate\Database\Query\Builder|\App\Company whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Company whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Company whereShortTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Company whereUpdatedAt($value)
 */
class Company extends Model
{
    public function galleries()
    {
        return $this->hasMany('App\Gallery');
    }
}
