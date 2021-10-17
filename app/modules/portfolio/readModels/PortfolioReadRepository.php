<?php

namespace app\modules\portfolio\readModels;

use app\modules\portfolio\models\Portfolio;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;

class PortfolioReadRepository
{
    public function findByAlias($alias): ? Portfolio
    {
        return Portfolio::find()
            ->andWhere(['alias' => $alias])
            ->limit(1)
            ->one();
    }

    public function getList(): DataProviderInterface
    {
        $query = Portfolio::find()
            ->andWhere(['status' => Portfolio::STATUS_ACTIVE]);

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 200,
                'pageSizeParam' => false
            ],
        ]);
    }

    public function getPortfolio($alias): Portfolio
    {
        return Portfolio::find()->andWhere(['alias' => $alias])->one();
    }
}
