<?php

namespace app\modules\review\seeders;

use app\modules\review\models\Review;
use app\modules\seeder\components\BaseSeeder;
use yii\helpers\Console;

class ReviewSeeder extends BaseSeeder
{
    public function seed($amountOfReviews)
    {
        Console::stdout(PHP_EOL . 'Reveiws');

        for ($i = 1; $i <= $amountOfReviews; $i++) {
            $reveiw = Review::create(
                $this->faker->name,
                $this->faker->realText(100),
                $this->faker->city,
                $this->faker->email
            );

            $reveiw->save();
            $this->addTime($reveiw);

            Console::stdout('.');
        }
    }
}