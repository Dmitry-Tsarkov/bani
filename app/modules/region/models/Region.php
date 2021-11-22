<?php

namespace app\modules\region\models;

use app\modules\admin\behaviors\SlugBehavior;
use app\modules\region\behaviors\RegionSlugBehavior;
use app\modules\seo\behaviors\SeoBehavior;
use app\modules\seo\valueObjects\Seo;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii2tech\ar\position\PositionBehavior;

/**
 * @mixin SeoBehavior
 * @mixin SlugBehavior
 * @mixin PositionBehavior
 *
 * @property int $id [int(11)]
 * @property int $position [int(11)]
 * @property int $status [int(11)]
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
 * @property string $region [varchar(255)]
 * @property string $description [varchar(255)]
 * @property string $meta_t [varchar(255)]
 * @property string $meta_d [varchar(255)]
 * @property string $meta_k [varchar(255)]
 * @property string $h1 [varchar(255)]
 * @property string $region_alias [varchar(255)]  Алиас региона
 * @property string $city [varchar(255)]
 * @property string $city_alias [varchar(255)]  Алиас города
 */

class Region extends ActiveRecord
{
    public static function tableName()
    {
        return 'regions';
    }

    public function behaviors()
    {
        return [
            RegionSlugBehavior::class,
            TimestampBehavior::class,
            PositionBehavior::class,
            SeoBehavior::class,
        ];
    }

    public static function create($city, $region, $description, ?Seo $seo = null): self
    {
        $self = new self();
        $self->city = $city;
        $self->region = $region;
        $self->description = $description;

        $self->seo = $seo ?? Seo::blank();

        return $self;
    }
}