<?php

namespace app\modules\kit\searchModels;

use app\modules\kit\models\Kit;
use app\modules\product\models\Product;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class KitSearch extends Model
{
    public $id;
    public $title;
    public $hint;
    public $product_id;

    public function rules()
    {
        return [
            [['id', 'title', 'hint'], 'string'],
            ['product_id', 'integer']
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Kit::find();

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['id' => $this->id]);
            $query->andFilterWhere(['title' => $this->title]);
            $query->andFilterWhere(['hint' => $this->hint]);
        }

        return new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['position' => SORT_ASC]],
        ]);
    }
}