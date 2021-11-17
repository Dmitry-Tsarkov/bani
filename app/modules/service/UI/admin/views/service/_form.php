<?php

use app\modules\service\forms\ServiceForm;
use app\modules\service\helpers\DropDownHelper;
use app\modules\service\models\Service;
use kartik\form\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var Service $service
 * @var ServiceForm $serviceForm
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
                    <?= $form->field($serviceForm, 'categoryId')->dropDownList($serviceForm->getCategoriesDropDown(), [
                        'prompt' => '',
                        'options' => $serviceForm->getCategoriesDropDownOptions()
                    ]) ?>
                    <?= $form->field($serviceForm, 'title') ?>
                    <?= $form->field($serviceForm, 'alias') ?>
                    <?= $form->field($serviceForm, 'price_type')->dropDownList(DropDownHelper::priceTypeDropDown()) ?>
                    <?= $form->field($serviceForm, 'price') ?>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-default box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">SEO</h3>
                </div>
                <div class="box-body">
                    <?= $form->field($serviceForm->seo, 'h1') ?>
                    <?= $form->field($serviceForm->seo, 'title') ?>
                    <?= $form->field($serviceForm->seo, 'description')->textarea(['rows' => 5]) ?>
                    <?= $form->field($serviceForm->seo, 'keywords')->hint('Фразы через запятую') ?>
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
                    <?= $form->field($serviceForm, 'description')->widget(CKEditor::class)->label(false) ?>
                </div>
            </div>
        </div>
    </div>


    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end() ?>
</div>



