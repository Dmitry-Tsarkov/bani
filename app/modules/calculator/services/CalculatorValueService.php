<?php

namespace app\modules\calculator\services;

use app\modules\calculator\forms\CalculatorValueForm;
use app\modules\calculator\models\CalculatorCharacteristc;
use app\modules\calculator\models\CalculatorValue;
use app\modules\calculator\repositories\CalculatorValueRepository;

class CalculatorValueService
{
    private $values;

    public function __construct(CalculatorValueRepository $values)
    {
        $this->values = $values;
    }

    public function create(CalculatorValueForm $form, CalculatorCharacteristc $characteristic): CalculatorValue
    {
        $value = CalculatorValue::create(
            $characteristic->id,
            $form->value,
            $form->price
        );

        $this->values->save($value);

        return $value;
    }

    public function edit($id, CalculatorValueForm $form)
    {
        $value = $this->values->getById($id);

        $value->edit(
            $form->value,
            $form->price
        );

        $this->values->save($value);
    }

    public function delete(int $id): void
    {
        $value = $this->values->getById($id);
        $value->delete();
    }
}