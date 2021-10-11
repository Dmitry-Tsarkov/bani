<?php

namespace app\modules\action\seeders;

use app\modules\action\models\Action;
use app\modules\seeder\components\BaseSeeder;
use app\modules\seeder\components\CopyUploadedFile;
use yii\helpers\Console;

class ActionSeeder extends BaseSeeder
{
    public function seed($amountOfActions)
    {
        Console::stdout(PHP_EOL . 'Actions');

        for ($i = 1; $i <= $amountOfActions; $i++) {
            $action = Action::create(
                $this->faker->realText(50),
                $this->faker->realText(20),
                $this->faker->realText(20),
                $this->faker->realText(200),
                time(),
                time()+7564340,
                $this->faker->realText(40),
                new CopyUploadedFile($this->getRandomImage('/actions'))
            );

            $action->save();
            $this->dateHelper->addTime($action);
            Console::stdout('.');
        }
    }
}