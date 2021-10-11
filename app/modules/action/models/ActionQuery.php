<?php

namespace app\modules\action\models;

use yii\db\ActiveQuery;

/**
 * @see Action
 */
class ActionQuery extends ActiveQuery
{
    public function active(): self
    {
        [$tableName, $alias] = $this->getTableNameAndAlias();
        return $this->andWhere([$alias . '.status' => Action::STATUS_ACTIVE]);
    }

    public function activeDate()
    {
        return $this->activeFrom()->activeTo();
    }

    public function activeFrom()
    {
        [$tableName, $alias] = $this->getTableNameAndAlias();
        return $this->andWhere([
            'or',
            ['<', $alias . '.active_from', time()],
            [$alias . '.active_from' => null],
        ]);
    }

    public function activeTo()
    {
        [$tableName, $alias] = $this->getTableNameAndAlias();
        return $this->andWhere([
            'or',
            ['>', $alias . '.active_to', time()],
            [$alias . '.active_to' => null],
        ]);
    }
}