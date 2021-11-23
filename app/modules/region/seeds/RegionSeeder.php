<?php

namespace app\modules\region\seeds;

use app\modules\region\models\Region;
use app\modules\seeder\components\BaseSeeder;
use app\modules\seeder\helpers\DateHelper;
use yii\helpers\Console;

class RegionSeeder extends BaseSeeder
{

    public function seed($amount_of_districts)
    {
        Console::stdout(PHP_EOL . 'Disctricts');

        $root = $this->getRoot();

       for ($i = 1; $i <= $amount_of_districts; $i++) {
            $district = Region::create(
                $root->id,
                $this->faker->city,
                $this->faker->realText(200),
                null,
                new CopyUploadedFile($this->getRandomImage('/categories'))
            );

            $district->appendTo($root);
            $this->dateHelper->addTime($district);
            $this->seedSubCategory($district);
            Console::stdout('.');
        }
    }

    private function seedSubCategory(Category $parentCategory)
    {
        for ($i = 0; $i <= 5; $i++) {
            $district = Category::create(
                $parentCategory->id,
                'Подкатегория (' . $parentCategory->title . ') ' . $i,
                $this->faker->realText(200),
                null,
                new CopyUploadedFile($this->getRandomImage('/categories'))
            );

            $district->appendTo($parentCategory);
            $this->addTime($district);

            Console::stdout('.');
        }
    }

    public function getRoot()
    {
        return Category::find()->andWhere(['depth' => 0])->one();
    }
}