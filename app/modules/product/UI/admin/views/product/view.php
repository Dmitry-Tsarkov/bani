<?php

use app\modules\product\forms\ImagesForm;
use app\modules\product\models\Product;
use app\modules\product\models\ProductImage;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\DetailView;

/**
 * @var View $this
 * @var Product $product
 */

$this->title = 'Редактирование товара "' . $product->title . '"';
$this->params['breadcrumbs'] = [
    ['label' => 'Товары', 'url' => ['index']],
    $product->title
];

$this->title = $product->title;

?>

<p>
    <?= Html::a('Редактировать', ['update', 'id' => $product->id], ['class' => 'btn btn-primary']) ?>
</p>
<div style="margin-bottom: 10px">
    <?php if (!$product->isActive()): ?>
        <?= Html::a(
            'Активность',
            ['activate', 'id' => $product->id],
            [
                'class' => 'btn btn-default btn-xs',
                'data-method' => 'post',
            ]
        ) ?>
    <?php else: ?>
        <?= Html::a(
            'Активность',
            ['deactivate', 'id' => $product->id],
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
                'model' => $product,
                'attributes' => [
                    'id',
                    [
                        'label' => 'Статус',
                        'format' => 'raw',
                        'value' => $product->isActive()
                            ? '<span class="label label-success" data-test="123">Активен</span>'
                            : '<span class="label label-danger">Неактивный</span>',
                    ],
                    'title',
                    'alias',
                    [
                        'label' => 'Категория',
                        'value' => $product->category->title ?? '-',
                    ],
                    [
                        'label' => 'Дата создания',
                        'value' => date('d.m.Y H:i', $product->created_at)
                    ],
                    [
                        'label' => 'Дата редактирования',
                        'value' => date('d.m.Y H:i', $product->updated_at)
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
        <?= $product->description ?>
    </div>
</div>
<div class="box box-default box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Фото</h3>
    </div>
    <div class="box-body">
        <?= FileInput::widget([
            'model' => new ImagesForm(),
            'attribute' => 'images[]',
            'pluginOptions' => [
                'theme' => 'fa',
                'uploadUrl' => Url::to(['upload', 'id' => $product->id]),
                'initialPreview' => array_map(function (ProductImage $image) {
                    return $image->getUploadedFileUrl('image');
                }, $product->images),
                'initialPreviewConfig' => array_map(function (ProductImage $image) {
                    return [
                        'key' => $image->id,
                        'caption' => $image->image,
                        'size' => filesize($image->getUploadedFilePath('image')),
                        'downloadUrl' => $image->getImageFileUrl('image'),
                        'url' => Url::to(['delete-image', 'id' => $image->product_id, 'photoId' => $image->id]),
                    ];
                }, $product->images),
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
            $.post("' . Url::to(['sort-images', 'id' => $product->id]) . '",
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
