<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Certificate
 *
 * @property integer $id
 * @property string $title
 * @property string $file_name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Certificate whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Certificate whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Certificate whereFileName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Certificate whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Certificate whereUpdatedAt($value)
 */
class Certificate extends Model
{
    //
}
