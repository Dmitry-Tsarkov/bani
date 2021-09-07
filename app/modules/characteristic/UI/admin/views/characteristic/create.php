<?php

use app\modules\characteristic\forms\CharacteristicCreateForm;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\web\View;

/**
 * @var View $this
 * @var CharacteristicCreateForm $createForm
 */

$this->title = 'Добавление новой характеристики';
$this->params['breadcrumbs'] = [
    ['label' => 'Характеристики', 'url' => ['index']],
    $this->title,
];

?>

<?php $form = ActiveForm::begin() ?>
<div class="box box-default box-solid">
    <div class="box-body">
        <?= $form->field($createForm, 'title'); ?>
        <?= $form->field($createForm, 'unit'); ?>
        <?= $form->field($createForm, 'type')->dropDownList($createForm->getTypesDropDown(), ['prompt' => '-- Выберете способ ввода --']); ?>
    </div>
</div>

<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end() ?>


