<?php

use app\modules\portfolio\models\Portfolio;
use app\modules\portfolio\searchModels\PortfolioSearch;
use app\modules\review\models\Review;
use kartik\grid\DataColumn;
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\data\DataProviderInterface;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var DataProviderInterface $dataProvider
 * @var PortfolioSearch $searchModel
 */

$this->title = 'Портфолио';
$this->params['breadcrumbs'] = [
    'Портфолио',
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
                Html::a('Добавить в портфолио', ['create'], ['class' => 'btn btn-success', 'data-pjax' => '0']) .
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
            'hAlign' => GridView::ALIGN_CENTER,
            'attribute' => 'id',
            'format' => 'raw',
            'width' => '70px',
        ],

        'title',
        'alias',
        [
            'class' => DataColumn::class,
            'hAlign' => GridView::ALIGN_CENTER,
            'attribute' => 'is_preview',
            'filter' => $searchModel->IsPreviewDropDown(),
            'value' => function(Portfolio $portfolio) {
                return $portfolio->is_preview
                    ? '<span class="label label-success" data-test="123">Да</span>'
                    : '<span class="label label-danger">Нет</span>';
            },
            'format' => 'raw',
            'width' => '100px',
        ],
        [
            'class' => DataColumn::class,
            'hAlign' => GridView::ALIGN_CENTER,
            'attribute' => 'status',
            'filter' => $searchModel->StatusDropDown(),
            'value' => function(Portfolio $portfolio) {
                return $portfolio->status
                    ? '<span class="label label-success" data-test="123">Актуальное</span>'
                    : '<span class="label label-danger">Неактуальное</span>';
            },
            'format' => 'raw',
            'width' => '100px',
        ],
        [
            'class' => ActionColumn::className(),
            'template' => '{view}',
            'buttons' => [
                'view' => function ($url) {
                    return Html::a('Просмотр', $url, ['class' => 'btn btn-primary  btn-xs', 'data-pjax' => '0']);
                },
            ],
        ],
    ]
]) ?>

