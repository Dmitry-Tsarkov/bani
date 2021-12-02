<?php

namespace app\modules\calculator\presentators;

use app\modules\calculator\models\CalculatorCharacteristc;
use app\modules\calculator\models\CalculatorValue;
use app\modules\calculator\repositories\CalculatorRepository;

class CalculatorPresentator
{
    private $calculators;

    public function __construct(CalculatorRepository $calculators)
    {
        $this->calculators = $calculators;
    }

    public function getCalculator($id)
    {
        $calculator = $this->calculators->getById($id);

        return [
            'calculator' => [
                'id' => $calculator->id,
                'title' => $calculator->title,
                'description' => $calculator->description,
                'image' => $calculator->getViewImageSrc(),
                'characteristics' => array_map(function (CalculatorCharacteristc $characteristc) {
                    return [
                        'title' => $characteristc->title,
                        'type' => $characteristc->type,
                        'values' => array_map(function (CalculatorValue $value) {
                            return [
                                'id' => $value->id,
                                'value' => $value->value,
                                'price' => $value->price,
                            ];
                        }, $characteristc->values)
                    ];
                }, $calculator->characteristics),
            ]
        ];
    }
}