<?php

namespace app\modules\characteristic\seeders;

use app\modules\characteristic\models\Characteristic;
use app\modules\characteristic\models\Value;
use app\modules\characteristic\models\Variant;
use app\modules\seeder\components\BaseSeeder;
use yii\helpers\Console;

class CharacteristicSeeder extends BaseSeeder
{
    private $characteristicIds = [];

    public function seed($amountOfCharacteristics, $amountOfVariants)
    {
        Console::stdout(PHP_EOL . 'Characteristics');

        $types = [
            Characteristic::TYPE_TEXT,
            Characteristic::TYPE_DROP_DOWN
        ];

        for ($i = 1; $i <= $amountOfCharacteristics; $i++) {
            $characteristic = Characteristic::create(
                $this->faker->realText(30),
                $this->faker->word,
                $this->faker->randomElement($types)
            );

            $characteristic->save();

            if ($characteristic->type == Characteristic::TYPE_DROP_DOWN) {
                $this->seedVariants($amountOfVariants, $characteristic->id);
            }

            Console::stdout('.');
        }

    }

    private function seedVariants($amountOfVariants, $id)
    {
        for ($i = 1; $i <= $amountOfVariants; $i++) {
            $variant = Variant::create(
                $id,
                $this->faker->numberBetween(1, 500)
            );

            $variant->save();
        }
    }
}