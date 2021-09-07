<?php

use app\modules\characteristic\forms\VariantForm;
use app\modules\characteristic\models\Variant;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\web\View;

/**
 * @var View $this
 * @var VariantForm $createForm
 * @var Variant $characteristic
 */

$this->title = 'Добавление нового варианта';
$this->params['breadcrumbs'] = [
    ['label' => 'Характеристики', 'url' => ['characteristic/index']],
    ['label' => $characteristic->title, 'url' => ['characteristic/update', 'id' => $characteristic->id]],
    ['label' => 'Варианты', 'url' => ['variant/index', 'id' => $characteristic->id]],
    $this->title,
];

?>
<?php $form = ActiveForm::begin() ?>
<div class="box box-default box-solid">
    <div class="box-body">
        <?= $form->field($createForm, 'value'); ?>
    </div>
</div>

<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end() ?>


