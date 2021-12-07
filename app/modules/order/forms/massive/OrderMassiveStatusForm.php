<?php

namespace app\modules\order\forms\massive;

use app\modules\order\models\OrderStatus;
use yii\base\Model;

class OrderMassiveStatusForm extends Model
{
    public $ids;
    public $statusId;

    public function formName()
    {
        return '';
    }

    public function rules()
    {
        return [
            [['ids', 'statusId'], 'required'],
            ['ids', 'each', 'rule' => ['integer']],
            ['statusId', 'integer'],
            ['statusId', 'in', 'range' => array_keys(OrderStatus::list())],
        ];
    }
}