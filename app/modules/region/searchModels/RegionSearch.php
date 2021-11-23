<?php

namespace app\modules\region\searchModels;


use app\modules\region\models\Region;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class RegionSearch extends Model
{
    public $id;
    public $status;
    public $city;
    public $district;
    public $district_alias;
    public $city_alias;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'city_alias', 'district_alias', 'city', 'district'], 'string'],
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
            $query->andFilterWhere(['like', 'city', $this->city]);
            $query->andFilterWhere(['like', 'city_alias', $this->city_alias]);
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