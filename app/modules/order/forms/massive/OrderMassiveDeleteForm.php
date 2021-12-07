<?php

namespace app\modules\order\forms\massive;

use yii\base\Model;

class OrderMassiveDeleteForm extends Model
{
    public $ids;

    public function formName()
    {
        return '';
    }

    public function rules()
    {
        return [
            ['ids', 'required'],
            ['ids', 'each', 'rule' => ['integer']],
        ];
    }
}