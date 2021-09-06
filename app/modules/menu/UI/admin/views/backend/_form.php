<?php

use app\modules\menu\enums\StatusEnum;
use app\modules\menu\models\MenuItem;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var MenuItem $menuItem
 */

?>

<?php $form = ActiveForm::begin() ?>
<div class="box box-default box-solid">
    <div class="box-body">
        <div class="col-xs-4">
            <?= $form->field($menuItem, 'status')->dropDownList(StatusEnum::list()); ?>
        </div>
        <div class="col-xs-4">
            <?= $form->field($menuItem, 'text'); ?>
        </div>
        <div class="col-xs-4">
            <?= $form->field($menuItem, 'link'); ?>
        </div>
    </div>
</div>

<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end() ?>
