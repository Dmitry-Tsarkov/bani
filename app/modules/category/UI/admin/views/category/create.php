<?php

/**
 * @var View $this
 * @var CategoryForm $createForm
 */

use app\modules\category\forms\CategoryForm;
use kartik\file\FileInput;
use kartik\form\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\web\View;

$this->title = 'Добавление категории';
$this->params['breadcrumbs'] = [
    ['label' => 'Категории', 'url' => ['category/index']],
    $this->title,
];

?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
<div class="row">
    <div class="col-md-6">
        <div class="box box-default box-solid">
            <div class="box-header with-border">Общее</div>
            <div class="box-body">
                <div class="col-md-6">
                    <div class="single-kartik-image is-dark">
                        <?= $form->field($createForm, 'image')->widget(FileInput::class, [
                            'pluginOptions' => [
                                'fileActionSettings' => [
                                    'showDrag' => false,
                                    'showZoom' => true,
                                    'showUpload' => false,
                                    'showDownload' => true,
                                ],
                                'showCaption' => false,
                                'showRemove' => false,
                                'showUpload' => false,
                                'showClose' => false,
                                'showCancel' => false,
                                'browseClass' => 'btn btn-primary btn-block',
                                'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                                'browseLabel' => 'Выберите файл',
                            ]
                        ]) ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <?= $form->field($createForm, 'title')->textInput(['class' => 'form-control transIt']) ?>
                    <?= $form->field($createForm, 'alias')->textInput(['class' => 'form-control transTo']) ?>
                    <?php if ($createForm->canMove()): ?>
                        <?= $form->field($createForm, 'parentId')->dropDownList(
                            $createForm->getCategoriesDropDown()
                        ) ?>
                    <?php endif ?>
                </div>
                <div class="col-md-12">
                    <?= $form->field($createForm, 'description')->textarea(['rows' => 8]) ?>
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-default box-solid">
            <div class="box-header with-border">SEO</div>
            <div class="box-body">
                <div class="typesize_choose_photo">
                    <?= $form->field($createForm->seo, 'h1') ?>
                    <?= $form->field($createForm->seo, 'title') ?>
                    <?= $form->field($createForm->seo, 'description')->textarea(['rows' => 5]) ?>
                    <?= $form->field($createForm->seo, 'keywords')->hint('Фразы через запятую') ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-default box-solid">
            <div class="box-header with-border">Описание снизу</div>
            <div class="box-body">
                <div class="col-xs-12">
                    <?= $form->field($createForm, 'bottom_description')->widget(CKEditor::class)->label(false) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end() ?>
