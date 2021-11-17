<?php

namespace app\modules\serviceCategory\searchModels;

use app\modules\serviceCategory\models\ServiceCategory;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ServiceCategorySearch extends Model
{
    public $id;
    public $title;
    public $alias;
    public $design;

    public function rules()
    {
        return [
            [['title', 'alias'], 'string'],
            [['id'], 'integer'],
            [['alias'], 'match', 'pattern' => '/^[0-9a-z-]+$/','message'=>'Только латинские буквы и знак "-"'],
        ];
    }

    public function search($params): ActiveDataProvider
    {
        $query = ServiceCategory::find()->andWhere(['>', 'depth', 0]);

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['id' => $this->id]);
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