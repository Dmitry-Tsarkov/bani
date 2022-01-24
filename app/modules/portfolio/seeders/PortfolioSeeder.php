<?php

namespace app\modules\portfolio\seeders;

use app\modules\portfolio\models\Portfolio;
use app\modules\seeder\components\BaseSeeder;
use app\modules\seeder\components\CopyUploadedFile;
use app\modules\seo\valueObjects\Seo;
use yii\helpers\Console;

class PortfolioSeeder extends BaseSeeder
{
    public function seed($amountOfPortfolios)
    {
        Console::stdout(PHP_EOL . 'Portfolios');

        for ($i = 1; $i <= $amountOfPortfolios; $i++) {
            $portfolio = Portfolio::create(
                $this->faker->realText(40),
                null,
                $this->faker->realText(400),
                $this->faker->realText(50),
                $this->faker->boolean(30),
                new CopyUploadedFile($this->getRandomImage('/portfolios')),
                Seo::blank()
            );

            $portfolio->status = Portfolio::STATUS_ACTIVE;
            $this->dateHelper->addTime($portfolio);
            $portfolio->save();

            Console::stdout('.');
        }
    }

}