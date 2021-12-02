<?php

use \app\modules\calculator\models\Calculator;
use kartik\file\FileInput;
use kartik\form\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var View $this
 * @var Calculator $calculator
 */

?>

<div class="box-body">
    <?php $form = ActiveForm::begin() ?>
    <div class="box box-default box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Описание</h3>
        </div>
        <div class="box-body">
            <div class="col-xs-8">
                <?= $form->field($calculator, 'title') ?>
            </div>
            <div class="col-xs-4">
                <div class="row-kartik-images">
                    <div class="single-kartik-image is-dark">
                        <?= $form->field($calculator, 'image')->widget(FileInput::class, [
                            'pluginOptions' => [
                                'theme' => 'fa',
                                'fileActionSettings' => [
                                    'showDrag' => false,
                                    'showZoom' => true,
                                    'showUpload' => false,
                                    'showDelete' => false,
                                    'showDownload' => true,
                                ],
                                'initialPreviewShowDelete' => false,
                                'initialPreviewDownloadUrl' => $calculator->getUploadedFileUrl('image'),
                                'showCaption' => false,
                                'showRemove' => false,
                                'showUpload' => false,
                                'showClose' => false,
                                'showCancel' => false,
                                'browseClass' => 'btn btn-primary btn-block',
                                'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                                'browseLabel' => 'Выберите картинку',
                                'deleteUrl' => Url::to(['/admin/news/news/delete-image', 'id' => $calculator->id]),
                                'initialPreview' => [
                                    $calculator->getUploadedFileUrl('image'),
                                ],
                                'initialPreviewConfig' => [
                                    $calculator->hasImage() ? [
                                        'caption' => $calculator->image,
                                        'size' => filesize($calculator->getUploadedFilePath('image'))
                                    ] : [],
                                ],
                                'initialPreviewAsData' => true,
                            ],
                            'options' => ['accept' => 'image/jpeg, image/pjpeg, image/png'],
                        ]); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <?= $form->field($calculator, 'description')->widget(CKEditor::class) ?>
                </div>
            </div>
        </div>
    </div>
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end() ?>
</div>




