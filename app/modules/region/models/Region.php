<?php

namespace app\modules\region\models;

use app\modules\admin\behaviors\SlugBehavior;
use app\modules\admin\traits\QueryExceptions;
use app\modules\region\behaviors\RegionSlugBehavior;
use app\modules\seo\behaviors\SeoBehavior;
use app\modules\seo\valueObjects\Seo;
use creocoder\nestedsets\NestedSetsBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii2tech\ar\position\PositionBehavior;

/**
 * @mixin NestedSetsBehavior
 * @mixin SeoBehavior
 * @mixin SlugBehavior
 * @mixin PositionBehavior
 *
 * @property int $id [int(11)]
 * @property int $position [int(11)]
 * @property int $status [int(11)]
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
 * @property string $district [varchar(255)]
 * @property string $description [varchar(255)]
 * @property string $meta_t [varchar(255)]
 * @property string $meta_d [varchar(255)]
 * @property string $meta_k [varchar(255)]
 * @property string $h1 [varchar(255)]
 * @property string $district_alias [varchar(255)]  Алиас региона
 * @property string $city [varchar(255)]
 * @property string $city_alias [varchar(255)]  Алиас города
 * @property int $parent_id [int(11)]
 * @property int $lft [int(11)]
 * @property int $rgt [int(11)]
 * @property int $depth [int(11)]
 */

class Region extends ActiveRecord
{
    use QueryExceptions;

    /**
     * @var Seo
     */
    public $seo;

    public static function tableName()
    {
        return 'regions';
    }

    public function behaviors()
    {
        return [
            RegionSlugBehavior::class,
            NestedSetsBehavior::class,
            TimestampBehavior::class,
            PositionBehavior::class,
            SeoBehavior::class,
        ];
    }

    public static function create($parentId, $city, $district, $description, ?Seo $seo = null): self
    {
        $self = new self();
        $self->parent_id = $parentId;
        $self->city = $city;
        $self->district = $district;
        $self->description = $description;

        $self->seo = $seo ?? Seo::blank();

        return $self;
    }

    public function edit($parentId, $city, $district, $description, ?Seo $seo = null): void
    {
        $this->parent_id = $parentId;
        $this->city = $city;
        $this->district = $district;
        $this->description = $description;

        $this->seo = $seo ?? Seo::blank();
    }

    public function beforeSave($insert)
    {
        $this->setAttribute('meta_t', $this->seo->getTitle());
        $this->setAttribute('meta_d', $this->seo->getDescription());
        $this->setAttribute('meta_k', $this->seo->getKeywords());
        $this->setAttribute('h1', $this->seo->getH1());

        return parent::beforeSave($insert);
    }

    public function afterFind()
    {
        $this->seo = new Seo(
            $this->getAttribute('meta_t'),
            $this->getAttribute('meta_d'),
            $this->getAttribute('meta_k'),
            $this->getAttribute('h1')
        );
        parent::afterFind();
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->updateAttributes(['parent_id' => $this->parents(1)->one()->id]);
        parent::afterSave($insert, $changedAttributes);
    }

    public function getParent()
    {
        return $this->hasOne(Region::class, ['id' => 'parent_id']);
    }

}