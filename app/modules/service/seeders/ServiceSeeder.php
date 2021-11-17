<?php

namespace app\modules\service\seeders;


use app\modules\service\models\Service;
use app\modules\service\models\ServiceImage;
use app\modules\seeder\components\BaseSeeder;
use app\modules\serviceCategory\models\ServiceCategory;
use yii\helpers\Console;

class ServiceSeeder extends BaseSeeder
{
    public function seed($amountInOneCategory, $amountOfImages)
    {
        $serviceCategoryIds = $this->getServiceCategoryIds();

        Console::stdout(PHP_EOL . 'Services');

        foreach ($serviceCategoryIds as $i => $categoryId) {
            for ($j = 1; $j <= $amountInOneCategory; $j++) {
                $service = Service::create(
                    $categoryId,
                    'Услуга подкатегории ' . $categoryId . ' # ' . $j,
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
    }

    private function getServiceCategoryIds()
    {
        return ServiceCategory::find()
            ->andWhere(['depth' => 2])
            ->select('id')
            ->column();
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