<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Partner
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $web_site
 * @property string $category
 * @property string $image
 * @property boolean $enabled
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Partner whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Partner whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Partner whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Partner whereWebSite($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Partner whereCategory($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Partner whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Partner whereEnabled($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Partner whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Partner whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Partner extends Model
{
    //
}
