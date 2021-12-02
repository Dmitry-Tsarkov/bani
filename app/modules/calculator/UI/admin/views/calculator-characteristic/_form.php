<?php

use app\modules\calculator\forms\CalculatorCharacteristicForm;
use app\modules\calculator\models\CalculatorCharacteristc;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var CalculatorCharacteristicForm $characteristicForm
 */

?>

<div class="box-body">
    <?php $form = ActiveForm::begin() ?>
    <div class="box box-default box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Описание</h3>
        </div>
        <div class="box-body">
            <?= $form->field($characteristicForm, 'title') ?>
            <div class="row">
                <div class="col-xs-12">
                    <?= $form->field($characteristicForm, 'type')
                        ->dropDownList(
                            [
                                CalculatorCharacteristc::TYPE_DROPDOWN => 'Выпадающий список',
                                CalculatorCharacteristc::TYPE_RADIO => 'Радио-кнопка'
                            ])
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end() ?>
</div>