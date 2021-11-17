<?php


namespace app\modules\service\searchModel;


use app\modules\admin\helpers\NestedSetsHelper;
use app\modules\service\models\Service;
use app\modules\serviceCategory\models\ServiceCategory;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ServiceSearch extends Model
{
    public $id;
    public $category_id;
    public $status;
    public $title;
    public $alias;

    public function rules()
    {
        return [
            [['id', 'category_id'], 'integer'],
            [['title', 'alias'], 'string'],
            ['status', 'in', 'range' => [0, 1], 'message' => 'Некоректный статус'],
        ];
    }

    public function search($params) :ActiveDataProvider
    {
        $query = Service::find();

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['id' => $this->id]);

            if ($this->category_id) {
                $category = ServiceCategory::findOne($this->category_id);
                $categoryIds = $category->children()->select('id')->column();
                $categoryIds[] = $category->id;
                $query->andWhere(['category_id' => $categoryIds]);
            }
            $query->andFilterWhere(['status' => $this->status]);
            $query->andFilterWhere(['like', 'title', $this->title]);
            $query->andFilterWhere(['like', 'alias', $this->alias]);
        }

        return new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => [
                'category_id' => SORT_ASC,
                'position' => SORT_ASC
            ]],
            'pagination' => ['defaultPageSize' => 40],
        ]);
    }

    public function categoriesDropDown()
    {
        $arr = ServiceCategory::find()
            ->andWhere(['>', 'depth', 0])
            ->select(['title', 'id', 'depth', 'lft'])
            ->orderBy('lft')
            ->asArray()
            ->indexBy('id')
            ->all();

        return array_map(function($row) {
            return NestedSetsHelper::depthTitle($row['title'], $row['depth']);
        }, $arr);
    }
}