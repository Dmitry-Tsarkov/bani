<?php

namespace app\modules\service\searchModel;

use app\modules\admin\helpers\NestedSetsHelper;
use app\modules\service\models\Service;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ServiceSearch extends Model
{
    public $id;
    public $status;
    public $title;
    public $alias;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'alias'], 'string'],
            ['status', 'in', 'range' => [0, 1], 'message' => 'Некоректный статус'],
        ];
    }

    public function search($params): ActiveDataProvider
    {
        $query = Service::find();

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['id' => $this->id]);
            $query->andFilterWhere(['status' => $this->status]);
            $query->andFilterWhere(['like', 'title', $this->title]);
            $query->andFilterWhere(['like', 'alias', $this->alias]);
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