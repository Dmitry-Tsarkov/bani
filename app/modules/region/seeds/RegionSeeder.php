<?php

namespace app\modules\region\seeds;

use app\modules\region\models\Region;
use app\modules\seeder\components\BaseSeeder;
use yii\helpers\Console;

class RegionSeeder extends BaseSeeder
{
    public function seed($amountOfRegions)
    {
        Console::stdout(PHP_EOL . 'Regions');

        for ($i = 1; $i <= $amountOfRegions; $i++) {
            $region = Region::create(
                $this->faker->city,
                $this->faker->city,
                $this->faker->realText(500)
            );

            $region->save();

            Console::stdout('.');
        }
    }
}