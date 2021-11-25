<?php

namespace app\modules\region\searchModels;


use app\modules\region\models\Region;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class RegionSearch extends Model
{
    public $id;
    public $status;
    public $title;
    public $district;
    public $district_alias;
    public $title_alias;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'title_alias', 'district_alias', 'title', 'district'], 'string'],
            [['description'], 'string'],
            ['status', 'in', 'range' => [0, 1], 'message' => 'Некоректный статус'],
        ];
    }

    public function search($params) :ActiveDataProvider
    {
        $query = Region::find();

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['id' => $this->id]);
            $query->andFilterWhere(['status' => $this->status]);
            $query->andFilterWhere(['like', 'title', $this->title]);
            $query->andFilterWhere(['like', 'title_alias', $this->title_alias]);
            $query->andFilterWhere(['like', 'district', $this->district]);
            $query->andFilterWhere(['like', 'district_alias', $this->district_alias]);
        }

        return new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => [
                'position' => SORT_ASC
            ]],
            'pagination' => ['defaultPageSize' => 40],
        ]);
    }
}