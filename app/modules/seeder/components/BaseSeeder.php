<?php


namespace app\modules\seeder\components;


use app\modules\seeder\helpers\DateHelper;
use Faker\Factory;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;

abstract class BaseSeeder
{
    protected $faker;
    protected $dateHelper;

    public function __construct(DateHelper $dateHelper)
    {
        $this->faker = Factory::create('ru_RU');
        $this->dateHelper = $dateHelper;
    }

    protected function addTime(ActiveRecord $model)
    {
        $this->dateHelper->addTime($model);
    }

    public function getImages($folder)
    {
        $path = Yii::getAlias('@app/modules/seeder/files/' . $folder);
        return FileHelper::findFiles($path);
    }

    public function getRandomImage($folder)
    {
        return $this->faker->randomElement($this->getImages($folder));
    }

    public function getUploadedFile($folder): CopyUploadedFile
    {
        return new CopyUploadedFile($this->getRandomImage($folder));
    }
}