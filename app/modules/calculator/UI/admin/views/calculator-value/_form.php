<?php

use app\modules\calculator\forms\CalculatorValueForm;
use app\modules\calculator\models\CalculatorCharacteristc;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var CalculatorValueForm $valueForm
 */

?>

<div class="box-body">
    <?php $form = ActiveForm::begin() ?>
    <div class="box box-default box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Описание</h3>
        </div>
        <div class="box-body">
            <?= $form->field($valueForm, 'value') ?>
            <div class="row">
                <div class="col-xs-12">
                    <?= $form->field($valueForm, 'price')?>
                </div>
            </div>
        </div>
    </div>
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end() ?>
</div>