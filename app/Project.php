<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Project
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $description_short
 * @property string $description_full
 * @property string $image
 * @property boolean $enabled
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Project whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Project whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Project whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Project whereDescriptionShort($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Project whereDescriptionFull($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Project whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Project whereEnabled($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Project whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Project extends Model
{
    //
}
