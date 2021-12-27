<?php

namespace app\modules\service\seeders;

use app\modules\service\models\Service;
use app\modules\service\models\ServiceImage;
use app\modules\seeder\components\BaseSeeder;
use yii\helpers\Console;

class ServiceSeeder extends BaseSeeder
{
    public function seed($amountOfServices, $amountOfImages)
    {
        Console::stdout(PHP_EOL . 'Services');

        for ($j = 1; $j <= $amountOfServices; $j++) {
            $service = Service::create(
                $this->faker->realText(35),
                Service::TYPE_RANGE,
                $this->faker->numberBetween(3000, 100000),
                $this->faker->realText(300)
            );

            $this->addServiceImages($service, $amountOfImages);

            $service->save();
            $this->addTime($service);

            Console::stdout('.');
        }
    }


    public function addServiceImages(Service $service, $amountOfImages)
    {
        for ($j = 1; $j <= $amountOfImages; $j++) {
            $service->addImage(
                ServiceImage::create(
                    $this->getUploadedFile('services')
                )
            );
        }
    }
}