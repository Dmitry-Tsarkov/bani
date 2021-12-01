<?php

namespace app\modules\calculator\forms;

use app\modules\calculator\models\Calculator;
use yii\base\Model;
use yii\web\UploadedFile;

class CalculatorForm extends Model
{
    public $title;
    public $description;
    public $image;

    public function __construct(?Calculator $calculator = null)
    {
        if (!empty($calculator)) {
            $this->title = $calculator->title;
            $this->description = $calculator->description;
        }

        parent::__construct();
    }

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title', 'description'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'description'  => 'Описание',
            'image' => 'Картинка',
        ];
    }

    public function beforeValidate(): bool
    {
        $this->image = UploadedFile::getInstance($this, 'image');
        return parent::beforeValidate();
    }
}