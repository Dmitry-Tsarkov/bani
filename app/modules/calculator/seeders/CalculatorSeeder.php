<?php

namespace app\modules\calculator\seeders;

use app\modules\calculator\models\CalculatorCharacteristc;
use app\modules\calculator\models\Calculator;
use app\modules\calculator\models\CalculatorValue;
use app\modules\characteristic\models\Characteristic;
use app\modules\seeder\components\BaseSeeder;
use yii\helpers\Console;

class CalculatorSeeder extends BaseSeeder
{
    public function seed($amountOfCharacteristics, $amountOfValues)
    {
        Console::stdout(PHP_EOL . 'Calculator');

        $calculators = Calculator::find()->all();

        foreach ($calculators as $calculator) {

            for ($i = 1; $i <= $amountOfCharacteristics; $i++) {
                $characteristic = CalculatorCharacteristc::create(
                    $calculator->id,
                    $this->faker->realText(20),
                    $this->faker->randomElement([
                        CalculatorCharacteristc::TYPE_DROPDOWN,
                        CalculatorCharacteristc::TYPE_RADIO
                    ])
                );

                $characteristic->save();

                for ($j = 1; $j <= $amountOfValues; $j++) {
                    $value = CalculatorValue::create(
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