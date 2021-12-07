<?php

namespace app\modules\product\models;

use app\modules\admin\traits\QueryExceptions;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii2tech\ar\position\PositionBehavior;

/**
 * @property Product $product
 *
 * @property int $id [int(11)]
 * @property int $product_id [int(11)]
 * @property int $position [int(11)]
 * @property int $status [int(11)]
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
 * @property string $title [varchar(255)]
 *
 */
class Addition extends ActiveRecord
{
    use QueryExceptions;

    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;

    public static function tableName()
    {
        return 'products_additional_options';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => PositionBehavior::class,
                'groupAttributes' => ['product_id']
            ],
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    public static function create($product_id, $title): self
    {
        $self = new self();

        $self->product_id = $product_id;
        $self->title = $title;
        $self->status = self::STATUS_ACTIVE;

        return $self;
    }

    public function rules()
    {
        return [
            [['title', 'status'], 'required'],
            [['title'], 'string'],
            [['status'], 'integer'],
            [['status'], 'in', 'range' => [0, 1], 'message' => 'Некорректный статус'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'status' => 'Статус',
            'title' => 'Параметр',
        ];
    }

    public function isActive(): bool
    {
        return (bool)$this->status;
    }

}