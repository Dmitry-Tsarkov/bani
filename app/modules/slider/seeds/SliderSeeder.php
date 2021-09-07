<?php

namespace app\modules\slider\seeds;

use app\modules\seeder\components\BaseSeeder;
use app\modules\slider\models\Slide;
use yii\helpers\Console;
use app\modules\seeder\components\CopyUploadedFile;

class SliderSeeder extends BaseSeeder
{
    public function seed($amountOfSlides)
    {
        Console::stdout(PHP_EOL . 'Slides');

        for ($i = 1; $i <= $amountOfSlides; $i++) {
            $slide = Slide::create(
                $this->faker->name,
                $this->faker->realText(100),
                $this->faker->boolean(80),
                new CopyUploadedFile($this->getRandomImage('/slides'))
            );

            $slide->save();
            $this->addTime($slide);
            Console::stdout('.');
        }
    }
}