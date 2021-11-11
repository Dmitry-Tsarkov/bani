<?php

namespace app\modules\feedback\searchModel;

use app\modules\feedback\models\Feedback;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;

class FeedbackQuestionSearch extends Model
{
    public $id;
    public $name;
    public $phone;
    public $email;
    public $description;
    public $type;
    public $status;
    public $created_at;
    public $updated_at;

    public function rules()
    {
        return [
            [['name', 'email', 'phone', 'description', 'type'], 'string'],
            [['status'], 'integer'],
        ];
    }

    public function search(array $params): DataProviderInterface
    {
        $query = Feedback::find()->andFilterWhere(['type'=>'faq']);

        if ($this->load($params) && $this->validate()){
            $query->andFilterWhere([
                'id' => $this->id,
                'status' => $this->status,
            ]);
            $query->andFilterWhere(['like', 'name', $this->name]);
            $query->andFilterWhere(['like', 'email', $this->email]);
            $query->andFilterWhere(['like', 'phone', $this->phone]);
            $query->andFilterWhere(['like', 'type', $this->type]);
            $query->andFilterWhere(['like', 'description', $this->description]);
        }

        return new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]]
        ]);
    }
}