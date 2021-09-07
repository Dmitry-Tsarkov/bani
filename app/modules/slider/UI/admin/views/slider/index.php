<?php

use app\helpers\LabelHelpers;
use app\modules\slider\helpers\DropdownHelper;
use app\modules\slider\models\Slide;
use app\modules\slider\searchModels\SlideSearch;
use kartik\grid\DataColumn;
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\data\DataProviderInterface;
use yii\grid\ActionColumn;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var DataProviderInterface $dataProvider
 * @var SlideSearch $searchModel
 */

$this->title = 'Слайды';
$this->params['breadcrumbs'] = [
    'Слайды',
];

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
                Html::a('Добавить слайд', ['create'], ['class' => 'btn btn-success', 'data-pjax' => '0']) .
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
            'value' => function (Slide $slide) {
                return
                    Html::a('<span class="glyphicon glyphicon-arrow-up"></span>',
                        [
                            'move-up',
                            'id' => $slide->id
                        ],
                        [
                            'class' => 'pjax-action',
                        ]) .
                    Html::a('<span class="glyphicon glyphicon-arrow-down"></span>',
                        [
                            'move-down',
                            'id' => $slide->id
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
            'format' => 'raw',
            'width' => '70px',
        ],
        'title',
        [
            'class' => DataColumn::class,
            'attribute' => 'image',
            'format' => 'raw',
            'value' => function(Slide $slide) {
                return $slide->hasImage() ? '<img src="' . $slide->getThumbFileUrl('image', 'thumb') . '">' : '';
            }
        ],
        [
            'class' => DataColumn::class,
            'attribute' => 'status',
            'label' => 'Статус',
            'filter' => $searchModel->StatusDropDown(),
            'format' => 'raw',
            'value' => function (Slide $slide) {
                return LabelHelpers::label(
                    ArrayHelper::getValue(DropDownHelper::statusDropDown(), $slide->isActive(), '-'),
                    $slide->isActive()
                );
            },
            'width' => '100px',
        ],
        [
            'class' => ActionColumn::className(),
            'template' => '{update} {delete}',
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a('Редактировать', $url, ['class' => 'btn btn-primary btn-xs', 'data-pjax' => '0']);
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
]) ?>
