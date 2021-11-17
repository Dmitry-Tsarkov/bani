<?php

namespace app\modules\product\forms;

use app\modules\kit\models\Kit;
use app\modules\product\models\Product;
use yii\base\Model;

class KitEditForm extends Model
{
    public $ids = [];

    public function __construct(?Product $product = null)
    {
        if ($product) {
            $this->ids = $product->kitIds;
        }
        parent::__construct();
    }

    public function rules()
    {
        return [
            ['ids', 'each', 'rule' => ['integer']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'ids' => 'Комплекты',
        ];
    }

    public function getKitsDropDown()
    {
        return Kit::find()
            ->indexBy('id')
            ->select('title')
            ->column();
    }
}