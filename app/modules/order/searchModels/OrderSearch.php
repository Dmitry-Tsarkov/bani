<?php

namespace app\modules\order\searchModels;

use app\modules\order\models\Order;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;

class OrderSearch extends Model
{
    public $id;
    public $name;
    public $phone;
    public $email;
    public $comment;
    public $type;
    public $status;
    public $created_at;
    public $updated_at;

    public function rules()
    {
        return [
            [['name', 'email', 'phone', 'comment', 'type'], 'string'],
            [['status'], 'integer'],
        ];
    }

    public function search(array $params): DataProviderInterface
    {
        $query = Order::find();

        if ($this->load($params) && $this->validate()){
            $query->andFilterWhere([
                'id' => $this->id,
                'status' => $this->status,
            ]);
            $query->andFilterWhere(['like', 'name', $this->name]);
            $query->andFilterWhere(['like', 'email', $this->email]);
            $query->andFilterWhere(['like', 'phone', $this->phone]);
            $query->andFilterWhere(['like', 'type', $this->type]);
            $query->andFilterWhere(['like', 'comment', $this->comment]);
        }

        return new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]]
        ]);
    }
}