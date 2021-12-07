<?php

namespace app\modules\product\seeders;

use app\modules\characteristic\models\Characteristic;
use app\modules\product\models\Addition;
use app\modules\product\models\Product;
use app\modules\product\models\ProductImage;
use app\modules\seeder\components\BaseSeeder;
use app\modules\category\models\Category;
use yii\helpers\Console;

class ProductSeeder extends BaseSeeder
{
    public function seed($amountInOneCategory, $amountOfImages, $amountOfAdditions)
    {
        $productCategoryIds = $this->getProductCategoryIds();

        Console::stdout(PHP_EOL . 'Products');

        foreach ($productCategoryIds as $i => $categoryId) {
            for ($j = 1; $j <= $amountInOneCategory; $j++) {
                $product = Product::create(
                    $categoryId,
                    'Товар подкатегории ' . $categoryId . ' # ' . $j,
                    Product::TYPE_RANGE,
                    $this->faker->numberBetween(3000, 100000),
                    $this->faker->realText(900),
                    $this->faker->realText(900)
                );

                $this->addProductImages($product, $amountOfImages);

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

                for ($k = 1; $k <= $amountOfAdditions; $k++) {
                    $addition = Addition::create(
                        $product->id,
                        $this->faker->realText(40)
                    );

                    $addition->save();
                    $this->addTime($addition);
                }

                Console::stdout('.');
            }
        }
    }

    private function getProductCategoryIds()
    {
        return Category::find()
            ->andWhere(['depth' => 2])
            ->select('id')
            ->column();
    }

    public function addProductImages(Product $product, $amountOfImages)
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