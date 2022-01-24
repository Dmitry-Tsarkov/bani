<?php

use app\modules\portfolio\forms\PortfolioForm;
use kartik\file\FileInput;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var PortfolioForm $createForm
 */

$this->title = 'Добавление портфолио';
$this->params['breadcrumbs'] = [
    ['label' => 'Портфолио', 'url' => ['index']],
    'Добавить',
];

?>

<?php $form = ActiveForm::begin() ?>
    <div class="box box-default box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Общее</h3>
        </div>
        <div class="box-body">
            <div class="col-md-8">
                <?= $form->field($createForm, 'title') ?>
                <?= $form->field($createForm, 'alias') ?>
                <?= $form->field($createForm, 'preview_text')->textarea(['rows' => 5]); ?>
                <?= $form->field($createForm, 'description')->textarea(['rows' => 7, 'cols' => 5]); ?>
            </div>
            <div class="col-md-4">
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
        </div>
    </div>
    <div class="box box-default box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">SEO</h3>
        </div>
        <div class="box-body">
            <?= $form->field($createForm->seo, 'h1') ?>
            <?= $form->field($createForm->seo, 'title') ?>
            <?= $form->field($createForm->seo, 'description')->textarea(['rows' => 5]) ?>
            <?= $form->field($createForm->seo, 'keywords')->hint('Фразы через запятую') ?>
        </div>
    </div>
<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end() ?>