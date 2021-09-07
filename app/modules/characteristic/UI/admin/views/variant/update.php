<?php

use app\modules\characteristic\forms\CharacteristicEditForm;
use app\modules\characteristic\models\Characteristic;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var Characteristic $characteristic
 * @var CharacteristicEditForm $updateForm
 */

$this->title = 'Редактирование варианта';
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
        <?= $form->field($updateForm, 'value') ?>
    </div>
    <div class="box-footer">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
