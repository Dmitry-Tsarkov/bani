<?php

namespace app\modules\category\searchModels;

use app\modules\category\models\Category;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class CategorySearch extends Model
{
    public $id;
    public $title;
    public $alias;
    public $status;
    public $design;

    public function rules()
    {
        return [
            [['title', 'alias'], 'string'],
            [['id'], 'integer'],
            [['alias'], 'match', 'pattern' => '/^[0-9a-z-]+$/','message'=>'Только латинские буквы и знак "-"'],
            ['status', 'in', 'range' => [0, 1], 'message' => 'Некоректный статус'],
        ];
    }

    public function search($params): ActiveDataProvider
    {
        $query = Category::find()->andWhere(['>', 'depth', 0]);

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['id' => $this->id]);
            $query->andFilterWhere(['status' => $this->status]);
            $query->andFilterWhere(['like', 'title', $this->title]);
            $query->andFilterWhere(['like', 'alias', $this->alias]);
        }

        return new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['lft' => SORT_ASC]],
            'pagination' => ['defaultPageSize' => 40],
        ]);
    }
}