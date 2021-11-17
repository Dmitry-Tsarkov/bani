<?php

use app\modules\kit\models\Kit;
use kartik\form\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var Kit $kit
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
                <?= $form->field($kit, 'title') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($kit, 'hint') ?>
            </div>
        </div>
        <?= $form->field($kit, 'text')->widget(CKEditor::class); ?>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end() ?>
    </div>
</div>
