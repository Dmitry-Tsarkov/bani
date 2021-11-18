<?php

namespace app\modules\regions\models;

use yii\db\ActiveRecord;

/**
 * @property int $id [int(11)]
 * @property int $position [int(11)]
 * @property int $status [int(11)]
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
 * @property string $city [varchar(255)]
 * @property string $region [varchar(255)]
 * @property string $alias [varchar(255)]
 * @property string $description [varchar(255)]
 * @property string $meta_t [varchar(255)]
 * @property string $meta_d [varchar(255)]
 * @property string $meta_k [varchar(255)]
 * @property string $h1 [varchar(255)]
 */

class Region extends ActiveRecord
{
    public static function tableName()
    {
        return 'regions';
    }

    public static function create($city, $region, $alias, $description): self
    {
        $self = new self();
        $self->city = $city;
        $self->region = $region;
        $self->alias = $alias;
        $self->description = $description;

        return $self;

    }
}