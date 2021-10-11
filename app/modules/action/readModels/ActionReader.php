<?php


namespace app\modules\action\readModels;


use app\modules\action\models\Action;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\web\NotFoundHttpException;

class ActionReader
{
    public function getActions(): DataProviderInterface
    {
        $query = Action::find()
            ->active()
            ->activeDate();

        return new ActiveDataProvider([
            'query' => $query
        ]);
    }

    public function getAction($alias): Action
    {
        $action = Action::find()
            ->andWhere(['alias' => $alias])
            ->active()
            ->activeDate()
            ->one();

        if (!$action) {
            throw new NotFoundHttpException('Акция не найдена');
        }

        return $action;
    }
}