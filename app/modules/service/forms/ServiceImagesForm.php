<?php

namespace app\modules\service\forms;

use yii\base\Model;
use yii\web\UploadedFile;

class ServiceImagesForm extends Model
{
    public $images;

    public function rules()
    {
        return [
            ['images', 'each', 'rule' => ['image', 'extensions' => 'jpeg, png, jpg', 'checkExtensionByMimeType' => false]]
        ];
    }

    public function attributeLabels()
    {
        return [
            'images' => 'Картинки',
        ];
    }

    public function beforeValidate()
    {
        $this->images = UploadedFile::getInstances($this, 'images');
        return parent::beforeValidate();
    }

}