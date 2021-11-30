<?php

namespace app\modules\calculator\repositories;

use app\modules\calculator\models\Calculator;
use DomainException;
use RuntimeException;

class CalculatorRepository
{
    public function save(Calculator $calculator)
    {
        if (!$calculator->save()) {
            throw new RuntimeException('Calculator saving error');
        }
    }

    public function getById($id): Calculator
    {
        if (!$calculator = Calculator::find()->andWhere(['id' => $id])->one()) {
            throw new DomainException('Calculator not found');
        }

        return $calculator;
    }

    public function delete(Calculator $calculator): void
    {
        if(!$calculator->delete()) {
            throw new DomainException('Calculator delete error');
        }
    }
}