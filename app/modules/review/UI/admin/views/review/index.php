<?php

use app\helpers\DateHelper;
use app\helpers\LabelHelpers;
use app\modules\review\helpers\ReviewHelper;
use app\modules\review\models\Review;
use app\modules\review\searchModels\ReviewSearch;
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
 * @var ReviewSearch $searchModel
 */

$this->title = 'Отзывы';
$this->params['breadcrumbs'] = ['Отзывы']

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
                Html::a('Добавить отзыв', ['create'], ['class' => 'btn btn-success', 'data-pjax' => '0']) .
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
            'attribute' => 'created_at',
            'label' => 'Дата отзыва',
            'width' => '100px',
            'value' => function (Review $review) {
                return DateHelper::forHuman($review->created_at, 'd n Y H:i');
            },
        ],
        [
            'class' => DataColumn::class,
            'vAlign' => GridView::ALIGN_MIDDLE,
            'label' => 'Фио',
            'format' => 'raw',
            'width' => '200px',
            'attribute' => 'name'
        ],

        [
            'class' => DataColumn::class,
            'attribute' => 'status',
            'label' => 'Статус',
            'filter' => [0 => 'Неактивный', 1 => 'Активный'],
            'format' => 'raw',
            'width' => '50px',
            'value' => function (Review $review) {
                return LabelHelpers::label(
                    ArrayHelper::getValue(ReviewHelper::statusDropDown(), $review->isActive(), '-'),
                    $review->isActive()
                );
            },
        ],
        [
            'class' => ActionColumn::class,
            'template' => '{update} {delete}',
            'width' => '180px',
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
])
?>

