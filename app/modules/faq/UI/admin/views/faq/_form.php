<?php

use app\modules\faq\models\Faq;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var Faq $faq
 */

?>
<div class="box box-default">
    <div class="box-body">
        <?php $form = ActiveForm::begin() ?>
        <?= $form->field($faq, 'status')->dropDownList([0 => 'Неактивный', 1 => 'Активный']); ?>
        <?= $form->field($faq, 'question'); ?>
        <?= $form->field($faq, 'answer')->textarea(['rows' => 3, 'cols' => 5]); ?>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end() ?>
    </div>
</div>
