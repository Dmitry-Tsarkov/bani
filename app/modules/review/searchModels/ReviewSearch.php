<?php

namespace app\modules\review\searchModels;

use app\modules\review\models\Review;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ReviewSearch extends Model
{
    public $id;
    public $status;
    public $name;
    public $description;
    public $email;
    public $city;

    public function rules()
    {
        return [
            [['name', 'description', 'city', 'email'], 'string'],
            [['id', 'status',], 'integer'],
        ];
    }

    public function search($params): ActiveDataProvider
    {
        $query = Review::find();

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['id' => $this->id]);
            $query->andFilterWhere(['status' => $this->status]);
            $query->andFilterWhere(['like', 'name', $this->name]);
            $query->andFilterWhere(['like', 'description', $this->description]);
            $query->andFilterWhere(['like', 'city', $this->city]);
            $query->andFilterWhere(['like', 'email', $this->email]);
        }

        return new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]],
            'pagination' => ['defaultPageSize' => 40],
        ]);
    }
    public function IsPreviewDropDown()
    {
        return [false => 'Нет', true => 'Да'];
    }

}