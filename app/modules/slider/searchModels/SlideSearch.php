<?php

namespace app\modules\slider\searchModels;

use app\modules\slider\models\Slide;
use yii\base\Model;
use yii\data\ActiveDataProvider;
/**
 * @property string $title [varchar(255)]
 * @property string $id [varchar(255)]
 * @property string $status [varchar(255)]
 */
class SlideSearch extends Model
{
    public $id;
    public $title;
    public $status;

    public function rules()
    {
        return [
            [['id', 'title', 'status'], 'string'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Slide::find();

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['id' => $this->id]);
            $query->andFilterWhere(['status' => $this->status]);
            $query->andFilterWhere(['like', 'title', $this->title]);
        }

        return new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['position' => SORT_ASC]],
        ]);
    }

    public function statusDropDown()
    {
        return [
            Slide::STATUS_DRAFT => 'Неактивный',
            Slide::STATUS_ACTIVE => 'Активный'
        ];
    }
}
