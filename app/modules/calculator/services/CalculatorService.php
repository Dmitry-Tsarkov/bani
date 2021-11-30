<?php

namespace app\modules\calculator\services;

use app\modules\calculator\forms\CalculatorForm;
use app\modules\calculator\models\Calculator;
use app\modules\calculator\repositories\CalculatorRepository;

class CalculatorService
{
    private $calculators;

    public function __construct(CalculatorRepository $calculators)
    {
        $this->calculators = $calculators;
    }

    public function create(CalculatorForm $form): Calculator
    {
        $calculator = Calculator::create(
            $form->title,
            $form->description
        );

        $this->calculators->save($calculator);

        return $calculator;
    }

    public function edit(int $id, CalculatorForm $form)
    {
        $calculator = $this->calculators->getById($id);

        $calculator->edit(
            $form->title,
            $form->description
        );

        $this->calculators->save($calculator);
    }

    public function delete(int $id): void
    {
        $calculator = $this->calculators->getById($id);
        $calculator->delete();
    }
}