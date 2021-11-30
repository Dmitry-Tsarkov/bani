<?php

use app\modules\calculator\forms\CalculatorForm;
use kartik\form\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var CalculatorForm $calculatorForm
 */

?>

<div class="box-body">
    <?php $form = ActiveForm::begin() ?>
    <div class="box box-default box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Описание</h3>
        </div>
        <div class="box-body">
            <?= $form->field($calculatorForm, 'title') ?>
            <div class="row">
                <div class="col-xs-12">
                    <?= $form->field($calculatorForm, 'description')->widget(CKEditor::class) ?>
                </div>
            </div>
        </div>
    </div>
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end() ?>
</div>



