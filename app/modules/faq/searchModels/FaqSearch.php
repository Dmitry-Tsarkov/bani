<?php


namespace app\modules\faq\searchModels;

use app\modules\faq\models\Faq;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class FaqSearch extends Model
{
    public $id;
    public $status;
    public $question;

    public function rules()
    {
        return [
            [['id', 'question', 'status'], 'string'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Faq::find();

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['id' => $this->id]);
            $query->andFilterWhere(['status' => $this->status]);
            $query->andFilterWhere(['like', 'question', $this->question]);
        }

        return new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['position' => SORT_ASC]],
        ]);
    }

    public function StatusDropDown()
    {
        return [0 => 'Неактивный', 1 => 'Активный'];
    }
}
