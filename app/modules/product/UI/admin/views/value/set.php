<?php

use app\modules\product\forms\ValueForm;
use app\modules\product\models\Product;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var Product $product
 * @var ValueForm $valueForm
 */

$this->title = 'Редактирование значения';
$this->params['breadcrumbs'] = [
    ['label' => 'Товары', 'url' => ['product/index']],
    ['label' => $product->title, 'url' => ['product/view', 'id' => $product->id]],
    'Редактирование значения',
];

?>

<div class="box box-default box-solid">
    <div class="box-body">
        <?php $form = ActiveForm::begin() ?>
        <?php if ($valueForm->isDropDown()): ?>
            <?= $form->field($valueForm, 'value')->dropDownList($valueForm->getVariantsDropDown())->label($valueForm->getLabel()) ?>
        <?php else: ?>
            <?= $form->field($valueForm, 'value')->label($valueForm->getLabel()) ?>
        <?php endif; ?>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end() ?>

