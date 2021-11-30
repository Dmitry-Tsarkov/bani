<?php

namespace app\modules\calculator\repositories;

use app\modules\calculator\models\CalculatorCharacteristc;
use app\modules\characteristic\models\Characteristic;
use DomainException;
use RuntimeException;

class CalculatorCharacteristicRepository
{
    public function save(CalculatorCharacteristc $characteristic)
    {
        if (!$characteristic->save()) {
            throw new RuntimeException('Characteristic saving error');
        }
    }

    public function getById($id): CalculatorCharacteristc
    {
        if (!$characteristic = CalculatorCharacteristc::find()->andWhere(['id' => $id])->one()) {
            throw new DomainException('Characteristic not found');
        }

        return $characteristic;
    }

    public function delete(CalculatorCharacteristc $characteristic): void
    {
        if(!$characteristic->delete()) {
            throw new DomainException('Characteristic delete error');
        }
    }
}