<?php

use kartik\form\ActiveForm;
use app\modules\region\forms\RegionForm;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var RegionForm $regionForm
 */

?>

<?php $form = ActiveForm::begin() ?>
    <div class="box box-default box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Общее</h3>
        </div>
        <div class="box-body">
            <div class="col-md-6">
                <?= $form->field($regionForm, 'city') ?>
                <?= $form->field($regionForm, 'city_alias') ?>

            </div>
            <div class="col-md-6">
                <?= $form->field($regionForm, 'district') ?>
                <?= $form->field($regionForm, 'district_alias') ?>
            </div>
            <div class="col-md-12">
                <?= $form->field($regionForm, 'description')->widget(CKEditor::class)->label('Контент') ?>
            </div>
        </div>

    </div>
    <div class="box box-default box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">SEO</h3>
        </div>
        <div class="box-body">
            <?= $form->field($regionForm->seo, 'h1') ?>
            <?= $form->field($regionForm->seo, 'title') ?>
            <?= $form->field($regionForm->seo, 'description')->textarea(['rows' => 5]) ?>
            <?= $form->field($regionForm->seo, 'keywords')->hint('Фразы через запятую') ?>
        </div>
    </div>
<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end() ?>