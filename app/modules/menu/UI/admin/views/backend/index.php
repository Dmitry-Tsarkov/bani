<?php

use app\modules\menu\enums\StatusEnum;
use app\modules\menu\models\MenuItem;
use kartik\grid\ActionColumn;
use kartik\grid\DataColumn;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 */

?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
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
                Html::a('Добавить', ['create'], ['class' => 'btn btn-success', 'data-pjax' => '0'])
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
            'attribute' => 'id',
            'width' => '10px',
        ],
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'hAlign' => GridView::ALIGN_CENTER,
            'value' => function (MenuItem $menuItem) {
                return
                    Html::a('<span class="glyphicon glyphicon-arrow-up"></span>', ['move-up', 'id' => $menuItem->id], [
                        'class' => 'pjax-action',
                        'data-pjax-container' => 'pjax-widget'
                    ]) .
                    Html::a('<span class="glyphicon glyphicon-arrow-down"></span>', ['move-down', 'id' => $menuItem->id], [
                        'class' => 'pjax-action',
                        'data-pjax-container' => 'pjax-widget'
                    ]);
            },
            'format' => 'raw',
            'width' => '10px',
        ],
        [
            'format' => 'raw',
            'width' => '50px',
            'attribute' => 'text',
        ],
        [
            'label' => 'Статус',
            'format' => 'raw',
            'width' => '50px',
            'attribute' => 'status',
            'value' => function (MenuItem $menuItem) {
                return StatusEnum::getStatus($menuItem->status);
            }
        ],
        [
            'class' => ActionColumn::class,
            'template' => '{update} {delete}',
            'width' => '180px',
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-xs', 'data-pjax' => '0']);
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