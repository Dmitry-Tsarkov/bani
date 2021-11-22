<?php

namespace app\modules\kit\seeds;

use app\modules\kit\models\Kit;
use app\modules\seeder\components\BaseSeeder;
use yii\helpers\Console;

class KitSeeder extends BaseSeeder
{
    public function seed($amountOfKits)
    {
        Console::stdout(PHP_EOL . 'Kits');

        for ($i = 1; $i <= $amountOfKits; $i++) {
            $kits = Kit::create(
                $this->faker->realText(20),
                $this->faker->realText(10),
                $this->faker->numberBetween(500, 100000),
                $this->faker->randomElement([Kit::TYPE_RANGE, Kit::TYPE_STATIC]),
                $this->faker->realText(1000),
                $this->faker->realText(500)
            );

            $kits->save();

            Console::stdout('.');
        }
    }
}