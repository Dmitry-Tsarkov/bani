<?php

use app\modules\kit\forms\KitForm;
use app\modules\kit\helpers\DropDownHelper;
use kartik\form\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var KitForm $kitForm
 */

?>
<div class="box box-default">
    <div class="box-body">
        <?php $form = ActiveForm::begin() ?>
        <div class="box-header with-border">
            <h3 class="box-title">Общее</h3>
        </div>
        <div class="box-body">
            <div class="col-md-6">
                <?= $form->field($kitForm, 'title') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($kitForm, 'hint') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($kitForm, 'price_type')->dropDownList(DropDownHelper::priceTypeDropDown()) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($kitForm, 'price') ?>
            </div>
            <?= $form->field($kitForm, 'text')->widget(CKEditor::class); ?>
            <?= $form->field($kitForm, 'bottom_text')->widget(CKEditor::class); ?>
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>
