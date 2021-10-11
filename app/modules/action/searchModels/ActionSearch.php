<?php


namespace app\modules\action\searchModels;


use app\modules\action\models\Action;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ActionSearch extends Model
{
    public $id;
    public $title;
    public $alias;

    public function rules()
    {
        return [
            [['title'], 'string'],
            ['id', 'integer'],
            [['alias'], 'match', 'pattern' => '/^[0-9a-z-]+$/','message'=>'Только латинские буквы и знак "-"'],
        ];
    }

    public function search($params): ActiveDataProvider
    {
        $query = Action::find();

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['id' => $this->id]);
            $query->andFilterWhere(['like', 'title', $this->title]);
            $query->andFilterWhere(['like', 'alias', $this->alias]);
        }

        return new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['position' => SORT_ASC]],
            'pagination' => ['defaultPageSize' => 40],
        ]);
    }
}