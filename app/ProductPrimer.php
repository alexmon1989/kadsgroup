<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ProductPrimer
 *
 * @property integer $id
 * @property string $title
 * @property integer $category_id
 * @property string $photo
 * @property string $package
 * @property string $description_small
 * @property string $description_full
 * @property string $using
 * @property string $tech_characteristics
 * @property string $exec_works
 * @property string $application
 * @property string $properties_using
 * @property string $phys_chem_properties
 * @property string $restrictions
 * @property string $safety
 * @property string $general_characteristics
 * @property string $price_1_name
 * @property string $price_1_val
 * @property string $price_2_name
 * @property string $price_2_val
 * @property string $price_3_name
 * @property string $price_3_val
 * @property string $price_4_name
 * @property string $price_4_val
 * @property boolean $enabled
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Category $category
 * @method static \Illuminate\Database\Query\Builder|\App\ProductPrimer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductPrimer whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductPrimer whereCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductPrimer wherePhoto($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductPrimer wherePackage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductPrimer whereDescriptionSmall($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductPrimer whereDescriptionFull($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductPrimer whereUsing($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductPrimer whereTechCharacteristics($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductPrimer whereExecWorks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductPrimer whereApplication($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductPrimer wherePropertiesUsing($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductPrimer wherePhysChemProperties($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductPrimer whereRestrictions($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductPrimer whereSafety($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductPrimer whereGeneralCharacteristics($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductPrimer wherePrice1Name($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductPrimer wherePrice1Val($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductPrimer wherePrice2Name($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductPrimer wherePrice2Val($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductPrimer wherePrice3Name($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductPrimer wherePrice3Val($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductPrimer wherePrice4Name($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductPrimer wherePrice4Val($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductPrimer whereEnabled($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductPrimer whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductPrimer whereUpdatedAt($value)
 */
class ProductPrimer extends Model
{
    protected $table = 'products_primer';

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
