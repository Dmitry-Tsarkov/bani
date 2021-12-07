<?php

namespace app\modules\order\models;

use app\modules\admin\traits\QueryExceptions;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * @property OrderStatus $status
 *
 * @property int $id [int(11)]
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
 * @property string $name [varchar(255)]
 * @property string $email [varchar(255)]
 * @property string $phone [varchar(255)]
 * @property string $comment
 * @property string $additional_options [varchar(255)]
 * @property int $product_id [int(11)]
 */
class Order extends ActiveRecord
{
    use QueryExceptions;

    const TYPE_PRODUCT = 'product';
    const TYPE_SERVICE = 'service';

    public static function tableName()
    {
        return 'orders';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public function attributeLabels()
    {
        return [
            'product_id' => 'Товар',
            'name' => 'ФИО',
            'email' => 'E-mail',
            'phone' => 'Теленфон',
            'created_at' => 'Дата',
            'comment' => 'Комментарий',
            'additional_options' => 'Дополнительные параметры'
        ];
    }

    public static function create($product_id, $name, $phone, $email, $comment, $additionalOptions = null): self
    {
        $self = new self();

        $self->name = $name;
        $self->product_id = $product_id;
        $self->phone = $phone;
        $self->email = $email;
        $self->comment = $comment;
        $self->additional_options = $additionalOptions;
        $self->status = OrderStatus::new();

        return $self;
    }

    public function changeStatus(OrderStatus $status)
    {
        $this->status = $status;
    }

    public function beforeSave($insert)
    {
        $this->setAttribute('status', $this->status->getValue());
        return parent::beforeSave($insert);
    }

    public function afterFind()
    {
        $this->status = new OrderStatus($this->getAttribute('status'));
        parent::afterFind();
    }
}