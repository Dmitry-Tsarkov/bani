<?php

namespace app\modules\order\models;

use app\modules\admin\traits\QueryExceptions;
use app\modules\product\models\Product;
use app\modules\service\models\Service;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * @property OrderStatus $status
 * @property Product $product
 * @property Service $service
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
 * @property int $service_id [int(11)]
 * @property string $type [varchar(255)]
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
            'type' => 'Зака на',
            'email' => 'E-mail',
            'phone' => 'Теленфон',
            'created_at' => 'Дата',
            'comment' => 'Комментарий',
            'additional_options' => 'Дополнительные параметры'
        ];
    }

    public static function product($product_id, $name, $phone, $email, $comment, $additionalOptions = null): self
    {
        $self = new self();

        $self->name = $name;
        $self->product_id = $product_id;
        $self->phone = $phone;
        $self->email = $email;
        $self->comment = $comment;
        $self->type = self::TYPE_PRODUCT;
        $self->additional_options = $additionalOptions;
        $self->status = OrderStatus::new();

        return $self;
    }

    public static function service($service_id, $name, $phone, $email, $comment): self
    {
        $self = new self();

        $self->name = $name;
        $self->service_id = $service_id;
        $self->phone = $phone;
        $self->email = $email;
        $self->comment = $comment;
        $self->type = self::TYPE_SERVICE;
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

    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    public function getService()
    {
        return $this->hasOne(Service::class, ['id' => 'service_id']);
    }

    public function getItemByType(Order $order)
    {
        if ($this->type == Order::TYPE_PRODUCT) {
            return $order->product;
        } elseif ($this->type == Order::TYPE_SERVICE) {
            return $order->service;
        }

        return '';
    }

    public function getItemLink()
    {
        if ($this->type == self::TYPE_PRODUCT) {
            return '/admin/product/product/view';
        }  elseif ($this->type == self::TYPE_SERVICE) {
            return '/admin/service/service/view';
        }
        return '';
    }
}