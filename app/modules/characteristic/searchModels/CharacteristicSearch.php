<?php

namespace app\modules\characteristic\searchModels;

use app\modules\characteristic\models\Characteristic;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class CharacteristicSearch extends Model
{
    public $id;
    public $title;
    public $unit;
    public $type;

    public function rules()
    {
        return [
            [['id', 'title', 'unit', 'type'], 'string'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Characteristic::find();

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere([
                'id'   => $this->id,
                'type' => $this->type,
            ]);
            $query->andFilterWhere(['like', 'title', $this->title]);
            $query->andFilterWhere(['like', 'unit',  $this->unit]);

        }

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }

}
