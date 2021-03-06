<?php

namespace app\modules\characteristic\models;

use app\modules\admin\traits\QueryExceptions;
use yii\db\ActiveRecord;
use function Composer\Autoload\includeFile;

/**
 * @property int $id [int(11)]
 * @property int $characteristic_id [int(11)]
 * @property int $product_id [int(11)]
 * @property int $variant_id [int(11)]
 * @property string $value [varchar(255)]
 *
 * @property Characteristic $characteristic
 * @property Variant $variant
 */

class Value extends ActiveRecord
{
    use QueryExceptions;

    public static function tableName()
    {
        return 'values';
    }

    public static function createValue($characteristicId, $value): Value
    {
        $self = new Value();
        $self->value = $value;
        $self->characteristic_id = $characteristicId;

        return $self;
    }

    public static function createVariant($characteristicId, $variantId): Value
    {
        $CharacteristicValue = new Value();
        $CharacteristicValue->characteristic_id = $characteristicId;
        $CharacteristicValue->variant_id = $variantId;

        return $CharacteristicValue;
    }

    public function getCharacteristic()
    {
        return $this->hasOne(Characteristic::class, ['id' => 'characteristic_id']);
    }

    public function getText()
    {
        return !empty($this->variant_id) ? $this->variant->value : $this->value;
    }

    public function getVariant()
    {
        return $this->hasOne(Variant::class, ['id' => 'variant_id']);
    }

    public function getLabel()
    {
        return $this->characteristic->title;
    }

    public function getUnit()
    {
        return $this->characteristic->unit;
    }

    public function getValue()
    {
        return $this;
    }
}
