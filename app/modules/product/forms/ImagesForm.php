<?php

namespace app\modules\product\forms;

use yii\base\Model;
use yii\web\UploadedFile;

class ImagesForm extends Model
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