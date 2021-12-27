<?php

use app\modules\service\forms\ServiceImagesForm;
use app\modules\service\models\Service;
use app\modules\service\models\ServiceImage;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\DetailView;

/**
 * @var View $this
 * @var Service $service
 */

$this->title = 'Редактирование услугуи "' . $service->title . '"';
$this->params['breadcrumbs'] = [
    ['label' => 'Услуги', 'url' => ['index']],
    $service->title
];

$this->title = $service->title;

?>

<p>
    <?= Html::a('Редактировать', ['update', 'id' => $service->id], ['class' => 'btn btn-primary']) ?>
</p>
<div style="margin-bottom: 10px">
    <?php if (!$service->isActive()): ?>
        <?= Html::a(
            'Активность',
            ['activate', 'id' => $service->id],
            [
                'class' => 'btn btn-default btn-xs',
                'data-method' => 'post',
            ]
        ) ?>
    <?php else: ?>
        <?= Html::a(
            'Активность',
            ['deactivate', 'id' => $service->id],
            [
                'class' => 'btn btn-success btn-xs',
                'data-method' => 'post',
            ]
        ) ?>
    <?php endif ?>
</div>
<div class="row">
    <div class="col-xs-6">
        <div class="box box-default box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Общее</h3>
            </div>
            <?= DetailView::widget([
                'model' => $service,
                'attributes' => [
                    'id',
                    [
                        'label' => 'Статус',
                        'format' => 'raw',
                        'value' => $service->isActive()
                            ? '<span class="label label-success" data-test="123">Активен</span>'
                            : '<span class="label label-danger">Неактивный</span>',
                    ],
                    'title',
                    'alias',
                    [
                        'label' => 'Дата создания',
                        'value' => date('d.m.Y H:i', $service->created_at)
                    ],
                    [
                        'label' => 'Дата редактирования',
                        'value' => date('d.m.Y H:i', $service->updated_at)
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
</div>

<div class="box box-default box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Описание</h3>
    </div>
    <div class="box-body">
        <?= $service->description ?>
    </div>
</div>
<div class="box box-default box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Фото</h3>
    </div>
    <div class="box-body">
        <?= FileInput::widget([
            'model' => new ServiceImagesForm(),
            'attribute' => 'images[]',
            'pluginOptions' => [
                'theme' => 'fa',
                'uploadUrl' => Url::to(['upload', 'id' => $service->id]),
                'initialPreview' => array_map(function (ServiceImage $image) {
                    return $image->getUploadedFileUrl('image');
                }, $service->images),
                'initialPreviewConfig' => array_map(function (ServiceImage $image) {
                    return [
                        'key' => $image->id,
                        'caption' => $image->image,
                        'size' => filesize($image->getUploadedFilePath('image')),
                        'downloadUrl' => $image->getImageFileUrl('image'),
                        'url' => Url::to(['delete-image', 'id' => $image->service_id, 'photoId' => $image->id]),
                    ];
                }, $service->images),
                'initialPreviewAsData' => true,
                'overwriteInitial' => false,
                'showClose' => false,
                'browseClass' => 'btn btn-primary text-right',
                'browseIcon' => '<i class="glyphicon glyphicon-download-alt"></i>',
                'browseLabel' => 'Выберите файл',
            ],
            'pluginEvents' => [
                'filesorted' => 'function(event, params) {
            console.log(params);
            $.post("' . Url::to(['sort-images', 'id' => $service->id]) . '",
                params,
            )
        }',
            ],
            'options' => [
                'multiple' => true,
            ],
        ]) ?>
    </div>
</div>
