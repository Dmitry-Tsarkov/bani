<?php

use app\modules\characteristic\models\Value;
use app\modules\kit\models\Kit;
use app\modules\product\forms\ImagesForm;
use app\modules\product\models\Addition;
use app\modules\product\models\Product;
use app\modules\product\models\ProductImage;
use kartik\file\FileInput;
use kartik\grid\ActionColumn;
use kartik\grid\DataColumn;
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;
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
    <div class="col-xs-8">
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
                    [
                        'label' => 'Название',
                        'attribute' => 'title',
                    ],
                    [
                        'label' => 'Алиас',
                        'attribute' => 'alias',
                    ],
                    [
                        'label' => 'Тип цены',
                        'value' => $product->getPriceType()
                    ],
                    [
                        'label' => 'Цена',
                        'attribute' => 'price',
                    ],
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

<div class="box box-default box-solid" id="test-values">
    <div class="box-header with-border">
        <h3 class="box-title">Значения (Характеристики)</h3>
    </div>
    <div class="box-body">
        <p>
            <?= Html::a('Добавить значение', ['value/request', 'id' => $product->id], ['class' => 'btn btn-success', 'data-pjax' => '0']) ?>
        </p>
        <?= GridView::widget([
            'dataProvider' => new ArrayDataProvider(['models' => $product->values]),
            'summaryOptions' => ['class' => 'text-right'],
            'bordered' => false,
            'pjax' => true,
            'pjaxSettings' => [
                'options' => [
                    'id' => 'pjax-values'
                ],
            ],
            'striped' => false,
            'hover' => true,
            'panel' => false,
            'export' => false,
            'toggleDataOptions' => [
                'all' => [
                    'icon' => 'resize-full',
                    'label' => 'Показать все',
                    'class' => 'btn btn-default',
                    'title' => 'Показать все'
                ],
                'page' => [
                    'icon' => 'resize-small',
                    'label' => 'Страницы',
                    'class' => 'btn btn-default',
                    'title' => 'Постаничная разбивка'
                ],
            ],
            'columns' => [
                [
                    'class' => DataColumn::class,
                    'vAlign' => GridView::ALIGN_MIDDLE,
                    'hAlign' => GridView::ALIGN_CENTER,
                    'attribute' => 'id',
                    'format' => 'raw',
                    'width' => '70px',
                ],
                [
                    'label' => 'Характеристика',
                    'value' => function (Value $value) {
                        return $value->characteristic->title;
                    }
                ],
                [
                    'label' => 'Значение',
                    'value' => function (Value $value) {
                        return $value->getText();
                    }
                ],
                [
                    'class' => ActionColumn::className(),
                    'template' => '{update} {delete}',
                    'noWrap' => true,
                    'buttons' => [
                        'update' => function ($url, Value $model, $key) {
                            return Html::a(
                                '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Редактировать',
                                ['value/set', 'id' => $model->product_id, 'characteristicId' => $model->characteristic_id],
                                ['class' => 'btn btn-primary btn-xs', 'data-pjax' => '0']);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('<i class="fa fa-trash" aria-hidden="true"></i>', [
                                'value/delete',
                                'productId' => $model->product_id,
                                'valueId' => $model->id,

                            ], [
                                'class' => 'btn btn-danger btn-xs pjax-action',
                                'data-pjax' => '0',
                                'data-confirm' => 'Вы уверены?',
                                'data-method' => 'post',
                                'data-pjax-container' => 'pjax-values'
                            ]);
                        },
                    ],
                ],
            ]
        ]);
        ?>
    </div>
</div>

<div class="box box-default box-solid" id="test-values">
    <div class="box-header with-border">
        <h3 class="box-title">Дополнительные параметры</h3>
    </div>
    <div class="box-body">
        <p>
            <?= Html::a('Добавить параметр', ['addition/create', 'productId' => $product->id], ['class' => 'btn btn-success', 'data-pjax' => '0']) ?>
        </p>
        <?= GridView::widget([
            'dataProvider' => new ArrayDataProvider(['models' => $product->additions]),
            'summaryOptions' => ['class' => 'text-right'],
            'bordered' => false,
            'pjax' => true,
            'pjaxSettings' => [
                'options' => [
                    'id' => 'pjax-values'
                ],
            ],
            'striped' => false,
            'hover' => true,
            'panel' => false,
            'export' => false,
            'toggleDataOptions' => [
                'all' => [
                    'icon' => 'resize-full',
                    'label' => 'Показать все',
                    'class' => 'btn btn-default',
                    'title' => 'Показать все'
                ],
                'page' => [
                    'icon' => 'resize-small',
                    'label' => 'Страницы',
                    'class' => 'btn btn-default',
                    'title' => 'Постаничная разбивка'
                ],
            ],
            'columns' => [
                [
                    'class' => DataColumn::class,
                    'vAlign' => GridView::ALIGN_MIDDLE,
                    'hAlign' => GridView::ALIGN_CENTER,
                    'attribute' => 'id',
                    'format' => 'raw',
                    'width' => '70px',
                ],
                [
                    'label' => 'Параметр',
                    'value' => function (Addition $addition) {
                        return $addition->title;
                    }
                ],
                [
                    'label' => 'Статус',
                    'format' => 'raw',
                    'value' => function (Addition $addition) {
                        return $addition->isActive()
                            ? '<span class="label label-success" data-test="123">Активен</span>'
                            : '<span class="label label-danger">Неактивный</span>';
                    }
                ],
                [
                    'class' => ActionColumn::className(),
                    'template' => '{update} {delete}',
                    'noWrap' => true,
                    'buttons' => [
                        'update' => function ($url, Addition $model, $key) {
                            return Html::a(
                                '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Редактировать',
                                ['addition/update', 'productId' => $model->product_id, 'additionId' => $model->id],
                                ['class' => 'btn btn-primary btn-xs', 'data-pjax' => '0']);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('<i class="fa fa-trash" aria-hidden="true"></i>', [
                                'addition/delete',
                                'productId' => $model->product_id,
                                'valueId' => $model->id,

                            ], [
                                'class' => 'btn btn-danger btn-xs pjax-action',
                                'data-pjax' => '0',
                                'data-confirm' => 'Вы уверены?',
                                'data-method' => 'post',
                                'data-pjax-container' => 'pjax-values'
                            ]);
                        },
                    ],
                ],
            ]
        ]);
        ?>
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
        <h3 class="box-title">Описание снизу</h3>
    </div>
    <div class="box-body">
        <?= $product->bottom_description ?>
    </div>
</div>
