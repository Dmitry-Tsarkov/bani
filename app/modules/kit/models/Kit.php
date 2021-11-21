<?php

namespace app\modules\kit\models;

use app\modules\admin\traits\QueryExceptions;
use app\modules\product\models\Product;
use yii\db\ActiveRecord;
use yii2tech\ar\position\PositionBehavior;

/**
 * @mixin PositionBehavior
 *
 * @property Product[] $products
 *
 * @property int $id [int(11)]
 * @property string $title
 * @property string $hint
 * @property string $text
 * @property int $position [int(11)]
 * @property int $price_type [int(11)]
 * @property int $price [int(11)]
 * @property string $bottom_text
 */
class Kit extends ActiveRecord
{
    use QueryExceptions;

    const TYPE_STATIC = 0;
    const TYPE_RANGE = 1;

    public function behaviors()
    {
        return [
            ['class' => PositionBehavior::class,
//            'groupAttributes' => ['product_id']
            ]
        ];
    }

    public static function tableName()
    {
        return 'kit';
    }

    public static function create($title, $hint, $price, $price_type, $text, $bottom_text): self
    {
        $self = new self;
        $self->title = $title;
        $self->price = $price;
        $self->price_type = $price_type;
        $self->hint = $hint;
        $self->text = $text;
        $self->bottom_text = $bottom_text;
        return $self;
    }

    public function edit($title, $hint, $price, $price_type, $text, $bottom_text)
    {
        $this->title = $title;
        $this->price = $price;
        $this->price_type = $price_type;
        $this->hint = $hint;
        $this->text = $text;
        $this->bottom_text = $bottom_text;
    }

    public function getPriceType()
    {
        return $this->price_type == self::TYPE_RANGE ? 'от' : '';
    }

    public function getProducts()
    {
        return $this->hasMany(Product::class, ['id' => 'product_id'])
            ->viaTable('products_kits', ['kit_id' => 'id']);
    }
}