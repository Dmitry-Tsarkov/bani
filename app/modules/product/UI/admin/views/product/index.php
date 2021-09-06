<?php

use app\helpers\LabelHelpers;
use app\modules\product\helpers\DropDownHelper;
use app\modules\product\models\Product;
use app\modules\product\searchModel\ProductSearch;
use kartik\grid\ActionColumn;
use kartik\grid\DataColumn;
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\data\DataProviderInterface;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var DataProviderInterface $dataProvider
 * @var ProductSearch $searchModel
 */

$this->title = 'Товары';
$this->params['breadcrumbs'] = ['Товары']

?>


<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'summaryOptions' => ['class' => 'text-right'],
    'bordered' => false,
    'pjax' => true,
    'pjaxSettings' => [
        'options' => [
            'id' => 'pjax-widget'
        ],
    ],
    'striped' => false,
    'hover' => true,
    'panel' => [
        'after' => false,
    ],
    'toolbar' => [
        [
            'content' =>
                Html::a('Добавить товар', ['create'], ['class' => 'btn btn-success', 'data-pjax' => '0']) .
                Html::a(
                    Icon::show('arrow-sync-outline'),
                    ['index'],
                    [
                        'data-pjax' => 0,
                        'class' => 'btn btn-default',
                        'title' => Yii::t('app', 'Reset')
                    ]
                )
        ],
        '{toggleData}',
    ],
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
            'value' => function (Product $product) {
                return
                    Html::a('<span class="glyphicon glyphicon-arrow-up"></span>',
                        [
                            'move-up',
                            'id' => $product->id
                        ],
                        [
                            'class' => 'pjax-action',
                        ]) .
                    Html::a('<span class="glyphicon glyphicon-arrow-down"></span>',
                        [
                            'move-down',
                            'id' => $product->id
                        ],
                        [
                            'class' => 'pjax-action',
                        ]);
            },
            'format' => 'raw',
            'width' => '60px',
        ],
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'hAlign' => GridView::ALIGN_CENTER,
            'attribute' => 'id',
            'width' => '70px',
        ],
        'title',
        [
            'attribute' => 'category_id',
            'filter' => $searchModel->categoriesDropDown(),
            'value' => function (Product $product) {
                return $product->category->title ?? '-';
            },
        ],
        [
            'class' => DataColumn::class,
            'attribute' => 'status',
            'label' => 'Статус',
            'filter' => [0 => 'Неактивный', 1 => 'Активный'],
            'format' => 'raw',
            'value' => function (Product $product) {
                return LabelHelpers::label(
                    ArrayHelper::getValue(DropDownHelper::statusDropDown(), $product->isActive(), '-'),
                    $product->isActive()
                );
            },
        ],
        [
            'class' => ActionColumn::class,
            'template' => '{view} {delete}',
            'width' => '180px',
            'buttons' => [
                'view' => function ($url, $model, $key) {
                    return Html::a('Просмотр', $url, ['class' => 'btn btn-primary btn-xs', 'data-pjax' => '0']);
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('<i class="fa fa-trash" aria-hidden="true"></i>', [
                        'delete',
                        'id' => $model->id,
                    ],
                        [
                            'class' => 'btn btn-danger btn-xs',
                            'data-pjax' => '0',
                            'data-confirm' => 'Вы уверены?',
                            'data-method' => 'post'
                        ]);
                },
            ],
        ],
    ]
])
?>



