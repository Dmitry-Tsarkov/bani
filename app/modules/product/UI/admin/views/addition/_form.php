<?php

use app\modules\product\models\Addition;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var Addition $addition
 */

?>
<div class="box box-default">
    <div class="box-body">
        <?php $form = ActiveForm::begin() ?>
        <?= $form->field($addition, 'status')->dropDownList([
            Addition::STATUS_ACTIVE => 'Активный',
            Addition::STATUS_DRAFT => 'Неактивный'
        ]); ?>
        <?= $form->field($addition, 'title'); ?>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end() ?>
    </div>
</div>
