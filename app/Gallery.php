<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Gallery
 *
 * @property integer $id
 * @property string $file_name
 * @property string $title
 * @property integer $company_id
 * @property boolean $is_main
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Company $company
 * @method static \Illuminate\Database\Query\Builder|\App\Gallery whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Gallery whereFileName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Gallery whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Gallery whereCompanyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Gallery whereIsMain($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Gallery whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Gallery whereUpdatedAt($value)
 */
class Gallery extends Model
{
    public function company()
    {
        return $this->belongsTo('App\Company');
    }
}
