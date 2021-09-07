<?php

use app\modules\characteristic\forms\CharacteristicCreateForm;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var CharacteristicCreateForm $createForm
 */

?>

<?php $form = ActiveForm::begin() ?>

<div class="row">
    <div class="col-xs-8">
        <?= $form->field($createForm, 'title'); ?>
        <?= $form->field($createForm, 'unit'); ?>
        <?= $form->field($createForm, 'type')->dropDownList($createForm->getTypesDropDown(), ['prompt' => '-- Выберете способ ввода --']); ?>
    </div>
</div>

<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end() ?>



