<?php

namespace app\modules\feedback\searchModel;

use app\modules\feedback\models\Feedback;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class FeedbackCalculationSearch extends Model
{
    public $id;
    public $name;
    public $phone;
    public $type;
    public $referer;
    public $status;
    public $created_at;
    public $updated_at;

    public function rules()
    {
        return [
            [['name', 'phone', 'type', 'referer'], 'string'],
            [['status'],'integer'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Feedback::find()->andFilterWhere(['type'=>'calculation']);

        if ($this->load($params) && $this->validate()){
            $query->andFilterWhere([
                'id' => $this->id,
                'status' => $this->status,
            ]);
            $query->andFilterWhere(['like', 'name', $this->name]);
            $query->andFilterWhere(['like', 'phone', $this->phone]);
            $query->andFilterWhere(['like', 'type', $this->type]);
            $query->andFilterWhere(['like', 'referer', $this->referer]);
        }

        return new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]]
        ]);
    }
}