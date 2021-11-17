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
                $this->faker->realText(100)
            );

            $kits->save();

            Console::stdout('.');
        }
    }
}