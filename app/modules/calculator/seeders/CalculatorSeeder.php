<?php

namespace app\modules\calculator\seeders;

use app\modules\calculator\models\CalculationCharacteristc;
use app\modules\calculator\models\Calculator;
use app\modules\calculator\models\CalculatorCharacteristicValue;
use app\modules\characteristic\models\Characteristic;
use app\modules\seeder\components\BaseSeeder;
use yii\helpers\Console;

class CalculatorSeeder extends BaseSeeder
{
    private $calculators = [
        1 => 'Цены на срубы бань',
        2 => 'Цены на срубы домов'
    ];

    public function seed($amountOfCharacteristics, $amountOfValues)
    {
        Console::stdout(PHP_EOL . 'Calculator');

        foreach ($this->calculators as $calculator_id => $calculator) {
            $calculator = Calculator::create(
                $this->faker->realText(100),
                $this->faker->realText(500)
            );

            $calculator->save();

            for ($i = 1; $i <= $amountOfCharacteristics; $i++) {
                $characteristic = CalculationCharacteristc::create(
                    $calculator_id,
                    $this->faker->realText(20),
                    $this->faker->randomElement([
                        CalculationCharacteristc::TYPE_DROPDOWN,
                        CalculationCharacteristc::TYPE_RADIO
                    ])
                );

                $characteristic->save();

                for ($j = 1; $j <= $amountOfValues; $j++) {
                    $value = CalculatorCharacteristicValue::create(
                        $i,
                        $this->faker->realText(30),
                        $this->faker->numberBetween(5000, 30000)
                    );

                    $value->save();
                }
            }

            Console::stdout('.');
        }
    }
}