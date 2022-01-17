<?php

use app\modules\category\forms\CategoryForm;

use app\modules\category\models\Category;
use kartik\file\FileInput;
use kartik\form\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var View $this
 * @var Category $category
 * @var CategoryForm $editForm
 */

$this->title = 'Редактирование ' . $category->title;
$this->params['breadcrumbs'] = [
    ['label' => 'Катекгории', 'url' => ['category/index']],
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
                            <?= $form->field($editForm, 'image')->widget(FileInput::class, [
                                'pluginOptions' => [
                                    'fileActionSettings' => [
                                        'showDrag' => false,
                                        'showZoom' => true,
                                        'showUpload' => false,
                                        'showDownload' => true,
                                    ],
                                    'deleteUrl' => Url::to(['delete-image', 'id' => $category->id, 'key' => 'image']),
                                    'showCaption' => false,
                                    'showRemove' => false,
                                    'showUpload' => false,
                                    'showClose' => false,
                                    'showCancel' => false,
                                    'browseClass' => 'btn btn-primary btn-block',
                                    'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                                    'browseLabel' => 'Выберите файл', 'initialPreview' => [
                                        $category->hasImage() ? $category->getImageSrc() : null,
                                    ],
                                    'initialPreviewConfig' => [
                                        $category->hasImage() ? [
                                            'caption' => $category->image,
                                            'size' => filesize($category->getUploadedFilePath('image')),
                                            'downloadUrl' => $category->getImageSrc(),
                                        ] : [],
                                    ],
                                    'initialPreviewAsData' => true,
                                ],
                                'options' => ['accept' => 'image/*'],
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($editForm, 'title') ?>
                        <?= $form->field($editForm, 'alias') ?>
                        <?php if ($editForm->canMove()): ?>
                            <?= $form->field($editForm, 'parentId')->dropDownList(
                                $editForm->getCategoriesDropDown()
                            ) ?>
                        <?php endif ?>
                        <?= $form->field($editForm, 'status')->dropDownList([
                                Category::STATUS_ACTIVE => 'Активный',
                                Category::STATUS_DRAFT => 'Неактивный'
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                        <?= $form->field($editForm, 'description')->textarea(['rows' => 8]) ?>
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
                        <?= $form->field($editForm->seo, 'h1') ?>
                        <?= $form->field($editForm->seo, 'title') ?>
                        <?= $form->field($editForm->seo, 'description')->textarea(['rows' => 5]) ?>
                        <?= $form->field($editForm->seo, 'keywords')->hint('Фразы через запятую') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-default box-solid">
                <div class="box-header with-border">Описание снизу</div>
                <div class="box-body">
                    <div class="col-xs-12">
                        <?= $form->field($editForm, 'bottom_description')->widget(CKEditor::class)->label(false) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php ActiveForm::end() ?>