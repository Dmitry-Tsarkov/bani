<?php

use app\modules\product\forms\RequestValueForm;
use app\modules\product\models\Product;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\View;

/* @var View $this
 * @var Product $product
 * @var RequestValueForm $requestForm
 */

$this->title = 'Добавление значения';
$this->params['breadcrumbs'] = [
    ['label' => 'Товары', 'url' => ['product/index']],
    ['label' => $product->title, 'url' => ['product/view', 'id' => $product->id]],
    'Добавление значения',
];

?>

<?php $form = ActiveForm::begin() ?>

<div class="box box-default box-solid">
    <div class="box-body">
        <?= $form->field($requestForm, 'characteristic_id')->widget(Select2::class, [
            'theme' => Select2::THEME_DEFAULT,
            'data' => $requestForm->getCharacteristicDropDown(),
             'options' => [
                 'options' => $requestForm->getDisabledOptions(),
             ]
        ]) ?>
        <?= Html::submitButton('Далее', ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end() ?>





