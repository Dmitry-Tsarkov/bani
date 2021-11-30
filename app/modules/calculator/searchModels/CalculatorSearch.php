<?php

namespace app\modules\calculator\searchModels;

use app\modules\calculator\models\Calculator;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class CalculatorSearch extends Model
{
    public $id;
    public $title;

    public function rules()
    {
        return [
            [['id', 'title'], 'string'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Calculator::find();

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['id' => $this->id]);
            $query->andFilterWhere(['like', 'title', $this->title]);
        }

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }
}