<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Video
 *
 * @property integer $id
 * @property string $youtube_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Video whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Video whereYoutubeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Video whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Video whereUpdatedAt($value)
 */
class Video extends Model
{
    //
}
