<?php

namespace app\modules\product\seeders;

use app\modules\category\models\Category;
use app\modules\characteristic\models\Characteristic;
use app\modules\product\models\Product;
use app\modules\product\models\ProductImage;
use app\modules\seeder\components\BaseSeeder;
use yii\helpers\Console;

class ProductSeeder extends BaseSeeder
{
    public function seed($amountInOneCategory, $amountOfImages)
    {
        $categoryIds = $this->getCategoryIds();

        Console::stdout(PHP_EOL . 'Products');

        foreach ($categoryIds as $i => $categoryId) {
            for ($j = 1; $j <= $amountInOneCategory; $j++) {
                $product = Product::create(
                    $categoryId,
                    'Товар подкатегории ' . $categoryId . ' # ' . $j,
                    Product::TYPE_RANGE,
                    $this->faker->numberBetween(3000, 100000),
                    $this->faker->realText(300)
                );

                $this->addImages($product, $amountOfImages);

                $characteristics = Characteristic::find()->all();

                foreach ($characteristics as $characteristic) {
                    if ($this->faker->boolean(80)) {
                        $product->setValue($characteristic->createValue(
                            $this->faker->randomElement(range(0, 100, 10)),
                            $this->faker->boolean(50)
                        ));
                    }
                }

                $product->save();
                $this->addTime($product);

                Console::stdout('.');
            }
        }
    }

    private function getCategoryIds()
    {
        return Category::find()
            ->andWhere(['depth' => 2])
            ->select('id')
            ->column();
    }

    public function addImages(Product $product, $amountOfImages)
    {
        for ($j = 1; $j <= $amountOfImages; $j++) {
            $product->addImage(
                ProductImage::create(
                    $this->getUploadedFile('products')
                )
            );
        }
    }

}