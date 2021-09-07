<?php

use app\modules\characteristic\forms\CharacteristicEditForm;
use app\modules\characteristic\models\Characteristic;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var Characteristic $characteristic
 * @var CharacteristicEditForm $editForm
 */

$this->title = $characteristic->title;
$this->params['breadcrumbs'] = [

    ['label' => 'Характеристики', 'url' => ['index']],
    $characteristic->title,
];

?>

<?php $this->beginContent('@app/modules/characteristic/UI/admin/views/characteristic/layout.php', compact('characteristic')) ?>

<?php $form = ActiveForm::begin() ?>
<?= $form->field($editForm, 'title') ?>
<?= $form->field($editForm, 'unit') ?>
<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end() ?>

<?php $this->endContent() ?>

