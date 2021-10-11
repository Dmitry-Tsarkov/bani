<?php

use app\modules\action\models\Action;
use kartik\datetime\DateTimePicker;
use kartik\file\FileInput;
use kartik\form\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var View $this
 * @var Action $action
 */

?>

<div class="box box-default box-solid">
    <div class="box-body">
        <?php $form = ActiveForm::begin() ?>
        <div class="row">
            <div class="col-md-6">
                <div class="box box-default box-solid">
                    <div class="box-header with-border">Общее</div>
                    <div class="box-body">
                        <?= $form->field($action, 'title'); ?>
                        <?= $form->field($action, 'alias'); ?>
                        <?= $form->field($action, 'activity_period'); ?>
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="single-kartik-image">
                    <?= $form->field($action, 'image')->widget(FileInput::class, [
                        'pluginOptions' => [
                            'fileActionSettings' => [
                                'showDrag' => false,
                                'showZoom' => true,
                                'showUpload' => false,
                                'showDelete' => false,
                                'showDownload' => true,
                            ],
                            'initialPreviewDownloadUrl' => $action->getUploadedFileUrl('image'),
                            'deleteUrl' => Url::to(['delete-image', 'id' => $action->id, 'key' => 'image']),
                            'showCaption' => false,
                            'showRemove' => false,
                            'showUpload' => false,
                            'showClose' => false,
                            'showCancel' => false,
                            'browseClass' => 'btn btn-primary btn-block',
                            'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                            'browseLabel' => 'Выберите файл',
                            'initialPreview' => [
                                $action->hasImage() ? $action->getImageFileUrl('image') : null,
                            ],
                            'initialPreviewConfig' => [
                                $action->hasImage() ? [
                                    'caption' => $action->image,
                                    'size' => filesize($action->getUploadedFilePath('image')),
                                    'downloadUrl' => $action->getImageFileUrl('image'),
                                ] : [],
                            ],
                            'initialPreviewAsData' => true,
                        ],
                        'options' => ['accept' => 'image/*'],
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="box box-default box-solid">
                    <div class="box-header with-border">Превью</div>
                    <div class="box-body">
                        <?= $form->field($action, 'preview_title'); ?>
                        <?= $form->field($action, 'preview_description'); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-default box-solid">
                    <div class="box-header with-border">Активность</div>
                    <div class="box-body">
                        <?= $form->field($action, 'active_from', [
                            'inputOptions' => [
                                'autocomplete' => 'off',
                                'value' => $action->active_from ? date('d.m.Y H:i', $action->active_from) : null
                            ]
                        ])->widget(DateTimePicker::class, [
                            'name' => 'dp_4',
                            'type' => DateTimePicker::TYPE_INPUT,
                            'convertFormat' => true,
                            'removeButton' => false,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'php:d.m.Y H:i',
                                'weekStart' => 1,
                            ]
                        ]); ?>
                        <?= $form->field($action, 'active_to', [
                            'inputOptions' => [
                                'autocomplete' => 'off',
                                'value' => $action->active_to ? date('d.m.Y H:i', $action->active_to) : null
                            ]
                        ])->widget(DateTimePicker::class, [
                            'name' => 'dp_4',
                            'type' => DateTimePicker::TYPE_INPUT,
                            'convertFormat' => true,
                            'removeButton' => false,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'php:d.m.Y H:i',
                                'weekStart' => 1,
                            ]
                        ]); ?>
                        <?= $form->field($action, 'status')->dropDownList([
                            Action::STATUS_DRAFT => 'Неактивный',
                            Action::STATUS_ACTIVE => 'Активный'
                        ])
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <?= $form->field($action, 'description')->widget(CKEditor::class); ?>
        <div class="box box-default box-solid">
            <div class="box-header with-border">SEO</div>
            <div class="box-body">
                <?= $form->field($action, 'h1')->hint('Фразы через запятую') ?>
                <?= $form->field($action, 'meta_t') ?>
                <?= $form->field($action, 'meta_d') ?>
                <?= $form->field($action, 'meta_k')->textarea(['rows' => 5]) ?>
            </div>
        </div>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end() ?>
    </div>
</div>