<?php

use app\modules\product\forms\ProductForm;
use app\modules\product\helpers\DropDownHelper;
use app\modules\product\models\Product;
use kartik\form\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var Product $product
 * @var ProductForm $productForm
 */

?>

<div class="box-body">
    <?php $form = ActiveForm::begin() ?>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-default box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Общее</h3>
                </div>
                <div class="box-body">
                    <?= $form->field($productForm, 'categoryId')->dropDownList($productForm->getCategoriesDropDown(), [
                        'prompt' => '',
                        'options' => $productForm->getCategoriesDropDownOptions()
                    ]) ?>
                    <?= $form->field($productForm, 'title') ?>
                    <?= $form->field($productForm, 'alias') ?>
                    <?= $form->field($productForm, 'price_type')->dropDownList(DropDownHelper::priceTypeDropDown()) ?>
                    <?= $form->field($productForm, 'price') ?>

                </div>
            </div>
        </div>
        <div class="col-md-6">
        <div class="box box-default box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">SEO</h3>
            </div>
            <div class="box-body">
                <?= $form->field($productForm->seo, 'h1') ?>
                <?= $form->field($productForm->seo, 'title') ?>
                <?= $form->field($productForm->seo, 'description')->textarea(['rows' => 5]) ?>
                <?= $form->field($productForm->seo, 'keywords')->hint('Фразы через запятую') ?>
            </div>
        </div>
        </div>

    </div>

    <div class="box box-default box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Описание</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12">
                    <?= $form->field($productForm, 'description')->widget(CKEditor::class)->label(false) ?>
                </div>
                <div class="col-xs-12">
                    <?= $form->field($productForm, 'bottom_description')->widget(CKEditor::class)->label(false) ?>
                </div>
            </div>
        </div>
    </div>

    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end() ?>
</div>



