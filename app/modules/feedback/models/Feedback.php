<?php

namespace app\modules\feedback\models;

use app\modules\admin\traits\QueryExceptions;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * @property FeedbackStatus $status
 *
 * @property int $id [int(11)]
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
 * @property string $name [varchar(255)]
 * @property string $phone [varchar(255)]
 * @property string $referer [varchar(255)]
 * @property string $type [varchar(255)]
 * @property string $description
 * @property string $email
 */
class Feedback extends ActiveRecord
{
    use QueryExceptions;

    const TYPE_CALCULATION = 'calculation';
    const TYPE_QUESTION = 'faq';

    public static function tableName()
    {
        return 'feedbacks';
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
            'name' => 'ФИО',
            'phone' => 'Теленфон',
            'type' => 'Тип',
            'created_at' => 'Дата',
            'referer' => 'Страница отправки',
            'description' => 'Комментарий'
        ];
    }

//    public static function calculation($name, $phone, $referer, $description = null): self
//    {
//        $self = new self();
//
//        $self->name = $name;
//        $self->phone = $phone;
//        $self->referer = $referer;
//        $self->description = $description;
//        $self->type = self::TYPE_CALCULATION;
//        $self->status = FeedbackStatus::new();
//
//        return $self;
//    }

    public static function question($name, $email, $phone, $referer, $description = null)
    {
        $self = new self();

        $self->name = $name;
        $self->email = $email;
        $self->phone = $phone;
        $self->referer = $referer;
        $self->description = $description;
        $self->type = self::TYPE_QUESTION;
        $self->status = FeedbackStatus::new();

        return $self;
    }

    public function changeStatus(FeedbackStatus $status)
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
        $this->status = new FeedbackStatus($this->getAttribute('status'));
        parent::afterFind();
    }
}