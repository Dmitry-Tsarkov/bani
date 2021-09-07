<?php

use app\modules\slider\models\Slide;
use kartik\file\FileInput;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var View $this
 * @var Slide $slide
 */

?>
<div class="box box-default">
    <div class="box-body">
<?php $form = ActiveForm::begin() ?>
<div class="row">
    <div class="col-xs-8">
        <?= $form->field($slide, 'status')->dropDownList([0 => 'Неактивный', 1 => 'Активный']); ?>
        <?= $form->field($slide, 'title')->textarea(['rows' => 3, 'cols' => 5]); ?>
        <?= $form->field($slide, 'description')->textarea(['rows' => 3, 'cols' => 5]); ?>
    </div>
    <div class="col-xs-4">
        <div class="single-kartik-image">
            <?= $form->field($slide, 'image')->widget(FileInput::class, [
                'pluginOptions' => [
                    'fileActionSettings' => [
                        'showDrag' => false,
                        'showZoom' => true,
                        'showUpload' => false,
                        'showDelete' => false,
                        'showDownload' => true,
                    ],
                    'initialPreviewDownloadUrl' => $slide->getUploadedFileUrl('image'),
                    'deleteUrl' => Url::to(['delete-image', 'id' => $slide->id, 'key' => 'image']),
                    'showCaption' => false,
                    'showRemove' => false,
                    'showUpload' => false,
                    'showClose' => false,
                    'showCancel' => false,
                    'browseClass' => 'btn btn-primary btn-block',
                    'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                    'browseLabel' => 'Выберите файл',
                    'initialPreview' => [
                        $slide->hasImage() ? $slide->getImageFileUrl('image') : null,
                    ],
                    'initialPreviewConfig' => [
                        $slide->hasImage() ? [
                            'caption' => $slide->image,
                            'size' => filesize($slide->getUploadedFilePath('image')),
                            'downloadUrl' => $slide->getImageFileUrl('image'),
                        ] : [],
                    ],
                    'initialPreviewAsData' => true,
                ],
                'options' => ['accept' => 'image/*'],
            ]) ?>
        </div>
    </div>
</div>
<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end() ?>
    </div>
</div>