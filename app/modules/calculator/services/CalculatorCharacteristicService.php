<?php

namespace app\modules\calculator\services;

use app\modules\calculator\forms\CalculatorCharacteristicForm;
use app\modules\calculator\models\Calculator;
use app\modules\calculator\models\CalculatorCharacteristc;
use app\modules\calculator\repositories\CalculatorCharacteristicRepository;

class CalculatorCharacteristicService
{
    private $characteristics;

    public function __construct(CalculatorCharacteristicRepository $characteristics)
    {
        $this->characteristics = $characteristics;
    }

    public function create(CalculatorCharacteristicForm $form, Calculator $calculator): CalculatorCharacteristc
    {
        $characteristic = CalculatorCharacteristc::create(
            $calculator->id,
            $form->title,
            $form->type
        );

        $this->characteristics->save($characteristic);

        return $characteristic;
    }

    public function edit(int $id, CalculatorCharacteristicForm $form)
    {
        $characteristic = $this->characteristics->getById($id);

        $characteristic->edit(
            $form->title,
            $form->type
        );

        $this->characteristics->save($characteristic);
    }

    public function delete(int $id): void
    {
        $characteristic = $this->characteristics->getById($id);
        $characteristic->delete();
    }
}