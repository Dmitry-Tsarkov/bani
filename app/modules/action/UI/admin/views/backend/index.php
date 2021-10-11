<?php

use app\modules\action\models\Action;
use app\modules\action\searchModels\ActionSearch;
use kartik\grid\ActionColumn;
use kartik\grid\DataColumn;
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\data\DataProviderInterface;
use yii\helpers\Html;
use yii\web\View;
/**
 * @var View $this
 * @var ActionSearch $searchModel
 * @var DataProviderInterface $dataProvider
 */
?>

<div class="row">
    <div class="col-lg-8">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'summaryOptions' => ['class' => 'text-right'],
            'bordered' => false,
            'pjax' => true,
            'pjaxSettings' => [
                'options' => [
                    'id' => 'slide-grid-view'
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
                        Html::a('Добавить акцию', ['create'], ['class' => 'btn btn-success', 'data-pjax' => '0']) .
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
                    'label' => 'Показать всех',
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
                    'label' => 'Сортировка',
                    'value' => function (Action $action) {
                        return
                            Html::a('<span class="glyphicon glyphicon-arrow-up"></span>',
                                [
                                    'move-up',
                                    'id' => $action->id
                                ],
                                [
                                    'class' => 'pjax-action',
                                    'data-pjax-container' => 'slide-grid-view'
                                ]) .
                            Html::a('<span class="glyphicon glyphicon-arrow-down"></span>',
                                [
                                    'move-down',
                                    'id' => $action->id
                                ],
                                [
                                    'class' => 'pjax-action',
                                    'data-pjax-container' => 'slide-grid-view'
                                ]);
                    },
                    'format' => 'raw',
                    'width' => '40px',
                ],
                [
                    'class' => DataColumn::class,
                    'vAlign' => GridView::ALIGN_MIDDLE,
                    'hAlign' => GridView::ALIGN_CENTER,
                    'format' => 'raw',
                    'label' => 'Картинка',
                    'width' => '150px',
                    'value' => function (Action $action) {
                        return Html::img($action->getThumbSrc());
                    },
                ],
                'title',
                [
                    'class' => ActionColumn::class,
                    'template' => '{update} {delete} ',
                    'width' => '180px',
                    'buttons' => [
                        'update' => function ($url, $model, $key) {
                            return Html::a('Редактировать', $url, ['class' => 'btn btn-primary btn-xs', 'data-pjax' => '0']);
                        },
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
    </div>
</div>




