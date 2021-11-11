<?php

namespace app\modules\faq\seeds;

use app\modules\faq\models\Faq;
use app\modules\seeder\components\BaseSeeder;
use app\modules\seeder\components\CopyUploadedFile;
use yii\helpers\Console;

class FaqSeeder extends BaseSeeder
{
    public function seed($amountOfFaqs)
    {
        Console::stdout(PHP_EOL . 'FAQ');

        for ($i = 1; $i <= $amountOfFaqs; $i++) {
            $faq = Faq::create(
                $this->faker->realText(100),
                $this->faker->realText(500)
            );

            $faq->status = Faq::STATUS_ACTIVE;
            $faq->save();

            Console::stdout('.');
        }
    }
}