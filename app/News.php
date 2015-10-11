<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\News
 *
 * @property integer $id
 * @property string $title
 * @property string $full_text
 * @property string $preview_text_small
 * @property string $preview_text_mid
 * @property string $thumbnail
 * @property boolean $is_on_main
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\News whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\News whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\News whereFullText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\News wherePreviewTextSmall($value)
 * @method static \Illuminate\Database\Query\Builder|\App\News wherePreviewTextMid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\News whereThumbnail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\News whereIsOnMain($value)
 * @method static \Illuminate\Database\Query\Builder|\App\News whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\News whereUpdatedAt($value)
 */
class News extends Model
{
    //
}
