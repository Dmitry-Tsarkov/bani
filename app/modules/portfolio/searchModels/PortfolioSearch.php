<?php

namespace app\modules\portfolio\searchModels;

use app\modules\portfolio\models\Portfolio;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class PortfolioSearch extends Model
{
    public $id;
    public $title;
    public $description;
    public $alias;
    public $status;
    public $is_preview;

    public function rules()
    {
        return [
            [['id', 'title', 'description', 'alias', 'status'], 'string'],
            [['is_preview'], 'boolean'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Portfolio::find();

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['id' => $this->id]);
            $query->andFilterWhere(['is_preview' => $this->is_preview]);
            $query->andFilterWhere(['status' => $this->status]);
            $query->andFilterWhere(['like', 'title', $this->title]);
            $query->andFilterWhere(['like', 'description', $this->description]);
            $query->andFilterWhere(['like', 'alias', $this->alias]);
        }

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }

    public function StatusDropDown()
    {
        return [0 => 'Неактивный', 1 => 'Активный'];
    }

    public function IsPreviewDropDown()
    {
        return [false => 'Нет', true => 'Да'];
    }


}