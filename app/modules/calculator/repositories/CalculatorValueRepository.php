<?php

namespace app\modules\calculator\repositories;

use app\modules\calculator\models\CalculatorValue;
use DomainException;
use RuntimeException;

class CalculatorValueRepository
{
    public function save(CalculatorValue $value)
    {
        if (!$value->save()) {
            throw new RuntimeException('Value saving error');
        }
    }

    public function getById($id): CalculatorValue
    {
        if (!$value = CalculatorValue::find()->andWhere(['id' => $id])->one()) {
            throw new DomainException('Value not found');
        }

        return $value;
    }

    public function delete(CalculatorValue $value): void
    {
        if(!$value->delete()) {
            throw new DomainException('Value delete error');
        }
    }
}