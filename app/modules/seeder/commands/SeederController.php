<?php

namespace app\modules\seeder\commands;

use app\modules\action\seeders\ActionSeeder;
use app\modules\category\seeders\CategorySeeder;
use app\modules\characteristic\seeders\CharacteristicSeeder;
use app\modules\faq\seeds\FaqSeeder;
use app\modules\kit\seeds\KitSeeder;
use app\modules\page\seeders\PageSeeder;
use app\modules\portfolio\seeders\PortfolioSeeder;
use app\modules\product\seeders\ProductSeeder;
use app\modules\review\seeders\ReviewSeeder;
use app\modules\slider\seeds\SliderSeeder;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;
use yii\helpers\FileHelper;

class SeederController extends Controller
{
    public function actionSeed()
    {
        Yii::createObject(PageSeeder::class)->seed(); gc_collect_cycles();
        Yii::createObject(ReviewSeeder::class)->seed(20); gc_collect_cycles();
        Yii::createObject(FaqSeeder::class)->seed(10); gc_collect_cycles();
        Yii::createObject(PortfolioSeeder::class)->seed(25); gc_collect_cycles();
        Yii::createObject(ActionSeeder::class)->seed(14); gc_collect_cycles();
        Yii::createObject(SliderSeeder::class)->seed(5); gc_collect_cycles();
        Yii::createObject(CharacteristicSeeder::class)->seed(4, 3); gc_collect_cycles();
        Yii::createObject(KitSeeder::class)->seed(100); gc_collect_cycles();
        Yii::createObject(CategorySeeder::class)->seed(); gc_collect_cycles();
        Yii::createObject(ProductSeeder::class)->seed(3, 2); gc_collect_cycles();
    }

    public function actionRefresh()
    {
        $this->actionClearDb();
        $this->actionClearUploads();
        Yii::$app->runAction('migrate', ['interactive' => 0]);
        $this->actionSeed();
        Console::stdout(PHP_EOL);
//        Yii::$app->runAction('elastic/remapping', ['interactive' => 0]);
//        Yii::$app->runAction('elastic/reindex', ['interactive' => 0]);
    }

    public function actionClearDb()
    {
        Yii::$app->getDb()->createCommand("SET foreign_key_checks = 0")->execute();
        foreach (Yii::$app->db->schema->tableNames as $tableName) {
            Yii::$app->getDb()->createCommand()->dropTable($tableName)->execute();
        }
        Yii::$app->getDb()->createCommand("SET foreign_key_checks = 1")->execute();
    }

    public function actionClearUploads()
    {
        if (!is_dir(Yii::getAlias('@webroot/uploads'))) {
            return;
        }

        foreach (FileHelper::findDirectories(Yii::getAlias('@webroot/uploads'), ['recursive' => false]) as $dir) {
            FileHelper::removeDirectory($dir);
        }
    }
}
