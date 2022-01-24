<?php

use app\modules\portfolio\forms\PortfolioForm;
use app\modules\portfolio\models\Portfolio;
use kartik\file\FileInput;
use kartik\form\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var View $this
 * @var Portfolio $portfolio
 * @var PortfolioForm $updateForm
 */

$this->title = 'Редактирование портфолио: ' . $portfolio->title;
$this->params['breadcrumbs'] = [
    ['label' => 'Портфолио', 'url' => ['index']],
    ['label' => $portfolio->title, 'url' => ['view', 'id' => $portfolio->id]],
    'Редактирование',
];
?>
<?php $form = ActiveForm::begin() ?>
<div class="box box-default box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Общее</h3>
    </div>
    <div class="box-body">
        <div class="col-md-8">
            <?= $form->field($updateForm, 'title') ?>
            <?= $form->field($updateForm, 'alias') ?>
            <?= $form->field($updateForm, 'preview_text')->textarea(['rows' => 5]); ?>
            <?= $form->field($updateForm, 'description')->widget(CKEditor::class); ?>
        </div>
        <div class="col-md-4">
            <div class="single-kartik-image is-dark">
                <?= $form->field($updateForm, 'image')->widget(FileInput::class, [
                    'pluginOptions' => [
                        'fileActionSettings' => [
                            'showDrag' => false,
                            'showZoom' => true,
                            'showUpload' => false,
                            'showDownload' => true,
                        ],
                        'deleteUrl' => Url::to(['delete-image', 'id' => $portfolio->id, 'key' => 'image']),
                        'showCaption' => false,
                        'showRemove' => false,
                        'showUpload' => false,
                        'showClose' => false,
                        'showCancel' => false,
                        'browseClass' => 'btn btn-primary btn-block',
                        'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                        'browseLabel' => 'Выберите файл', 'initialPreview' => [
                            $portfolio->hasImage() ? $portfolio->getImageSrc() : null,
                        ],
                        'initialPreviewConfig' => [
                            $portfolio->hasImage() ? [
                                'caption' => $portfolio->image,
                                'size' => filesize($portfolio->getUploadedFilePath('image')),
                                'downloadUrl' => $portfolio->getImageSrc(),
                            ] : [],
                        ],
                        'initialPreviewAsData' => true,
                    ],
                    'options' => ['accept' => 'image/*'],
                ]) ?>
            </div>
        </div>
    </div>
</div>

<div class="box box-default box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">SEO</h3>
    </div>
    <div class="box-body">
        <?= $form->field($updateForm->seo, 'h1') ?>
        <?= $form->field($updateForm->seo, 'title') ?>
        <?= $form->field($updateForm->seo, 'description')->textarea(['rows' => 5]) ?>
        <?= $form->field($updateForm->seo, 'keywords')->hint('Фразы через запятую') ?>
    </div>
</div>

<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end() ?>

