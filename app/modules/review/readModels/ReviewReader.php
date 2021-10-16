<?php

namespace app\modules\review\readModels;

use app\modules\review\models\Review;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\helpers\VarDumper;

class ReviewReader
{
    public function getReviews(): DataProviderInterface
    {
        $query = Review::find()
            ->orderBy(['created_at' => SORT_DESC])
            ->andWhere(['status' => Review::STATUS_ACTIVE]);

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'defaultPageSize' => 4,
            ],
        ]);
    }

}