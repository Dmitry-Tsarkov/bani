<?php

namespace app\modules\serviceCategory\seeders;

use app\modules\serviceCategory\models\ServiceCategory;
use app\modules\seeder\components\BaseSeeder;
use app\modules\seeder\components\CopyUploadedFile;
use yii\helpers\Console;

class ServiceCategorySeeder extends BaseSeeder
{
    private $categories = [
        'Фундамент',
        'Отделка сруба',
        'Другие услуги',
        'Срубы под ключ',
    ];

    public function seed()
    {
        Console::stdout(PHP_EOL . 'Service_categories');

        $root = $this->getRoot();

        foreach ($this->categories as $categoryTitle) {
            $category = ServiceCategory::create(
                $root->id,
                $categoryTitle,
                $this->faker->realText(200),
                null,
                new CopyUploadedFile($this->getRandomImage('/serviceCategories'))
            );

            $category->appendTo($root);
            $this->dateHelper->addTime($category);
            $this->seedSubCategory($category);
            Console::stdout('.');
        }
    }

    private function seedSubCategory(ServiceCategory $parentCategory)
    {
        for ($i = 0; $i <= 5; $i++) {
            $category = ServiceCategory::create(
                $parentCategory->id,
                'Подкатегория (' . $parentCategory->title . ') ' . $i,
                $this->faker->realText(200),
                null,
                new CopyUploadedFile($this->getRandomImage('/serviceCategories'))
            );

            $category->appendTo($parentCategory);
            $this->addTime($category);

            Console::stdout('.');
        }
    }

    public function getRoot()
    {
        return ServiceCategory::find()->andWhere(['depth' => 0])->one();
    }
}