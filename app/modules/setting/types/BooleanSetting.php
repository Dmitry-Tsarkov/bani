<?php

namespace app\modules\setting\types;

use app\modules\setting\models\Setting;
use yii\bootstrap\ActiveForm;

class BooleanSetting extends Setting
{
    const TYPE = 'boolean';
    const NAME = 'BOOL';

    public function formField(ActiveForm $form)
    {
        return $form->field($this, 'value')
            ->checkbox()
            ->hint(nl2br($this->hint), ['options' => ['class' => 'text-muted']])->label($this->title);
    }

    public function getValue()
    {
        return (bool)parent::getValue();
    }

    public function getAdminValue()
    {
        return $this->value ? 'Да' : 'Нет';
    }
}