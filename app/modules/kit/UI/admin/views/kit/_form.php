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
        <?= $form->field($kit, 'text')->widget(CKEditor::class); ?>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end() ?>
    </div>
</div>
