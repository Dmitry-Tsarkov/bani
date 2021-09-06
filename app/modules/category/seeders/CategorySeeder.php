<?php

namespace app\modules\category\seeders;

use app\modules\category\models\Category;
use app\modules\seeder\components\BaseSeeder;
use app\modules\seeder\components\CopyUploadedFile;
use yii\helpers\Console;

class CategorySeeder extends BaseSeeder
{
    private $categories = [
        'Проекты бань',
        'Проекты домов',
        'Виды срубов',
        'Беседки',
        'Фундамент',
        'Отделка сруба',
        'Другие услуги',
        'Срубы под ключ',
    ];

    public function seed()
    {
        Console::stdout(PHP_EOL . 'Categories');

        $root = $this->getRoot();

        foreach ($this->categories as $categoryTitle) {
            $category = Category::create(
                $root->id,
                $categoryTitle,
                $this->faker->realText(200),
                null,
                new CopyUploadedFile($this->getRandomImage('/categories'))
            );

            $category->appendTo($root);
            $this->dateHelper->addTime($category);
            $this->seedSubCategory($category);
            Console::stdout('.');
        }
    }

    private function seedSubCategory(Category $parentCategory)
    {
        for ($i = 0; $i <= 5; $i++) {
            $category = Category::create(
                $parentCategory->id,
                'Подкатегория (' . $parentCategory->title . ') товар ' . $i,
                $this->faker->realText(200),
                null,
                new CopyUploadedFile($this->getRandomImage('/categories'))
            );

            $category->appendTo($parentCategory);
            $this->addTime($category);

            Console::stdout('.');
        }
    }

    public function getRoot()
    {
        return Category::find()->andWhere(['depth' => 0])->one();
    }
}