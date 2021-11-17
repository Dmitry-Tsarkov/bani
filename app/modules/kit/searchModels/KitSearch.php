<?php

namespace app\modules\kit\searchModels;

use app\modules\kit\models\Kit;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class KitSearch extends Model
{
    public $id;
    public $text;

    public function rules()
    {
        return [
            [['id', 'text'], 'string'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Kit::find();

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['id' => $this->id]);
            $query->andFilterWhere(['text' => $this->text]);
        }

        return new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['position' => SORT_ASC]],
        ]);
    }
}