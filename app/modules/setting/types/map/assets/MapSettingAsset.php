<?php

namespace app\modules\setting\types\map\assets;

use yii\web\AssetBundle;
use yii\web\YiiAsset;

class MapSettingAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/setting/types/map/resources';
    public $publishOptions = [
        'forceCopy' => YII_ENV_DEV,
    ];

    public function init()
    {
        $this->js = [
            'https://api-maps.yandex.ru/2.1/?lang=ru_RU&onload=mapsetting&mode=debug&apikey=' . \Yii::$app->params['yandex']['apikey'],
            'js/script.js',
        ];

        parent::init();
    }
}