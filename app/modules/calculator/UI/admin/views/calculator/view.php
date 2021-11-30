<?php

use app\modules\product\models\Product;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/**
* @var View $this
* @var \app\modules\calculator\models\Calculator $calculator
*/

$this->title = 'Калькулятор "' . $calculator->title . '"';
$this->params['breadcrumbs'] = [
['label' => 'Калькуляторы', 'url' => ['index']],
$calculator->title
];

$this->title = $calculator->title;

?>

<p>
    <?= Html::a('Редактировать', ['update', 'id' => $calculator->id], ['class' => 'btn btn-primary btn-xs']) ?>
</p>

<div class="row">
    <div class="col-xs-8">
        <div class="box box-default box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Общее</h3>
            </div>
            <?= DetailView::widget([
                'model' => $calculator,
                'attributes' => [
                    'id',
                    [
                        'label' => 'Название',
                        'attribute' => 'title',
                    ],
                    [
                        'label' => 'Описание',
                        'attribute' => 'description',
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
</div>

<!--<div class="box box-default box-solid" id="test-values">-->
<!--    <div class="box-header with-border">-->
<!--        <h3 class="box-title">Значения</h3>-->
<!--    </div>-->
<!--    <div class="box-body">-->
<!--        <p>-->
<!--            --><?//= Html::a('Добавить значение', ['value/request', 'id' => $calculator->id], ['class' => 'btn btn-success', 'data-pjax' => '0']) ?>
<!--        </p>-->
<!--        --><?//= GridView::widget([
//            'dataProvider' => new ArrayDataProvider(['models' => $calculator->values]),
//            'summaryOptions' => ['class' => 'text-right'],
//            'bordered' => false,
//            'pjax' => true,
//            'pjaxSettings' => [
//                'options' => [
//                    'id' => 'pjax-values'
//                ],
//            ],
//            'striped' => false,
//            'hover' => true,
//            'panel' => false,
//            'export' => false,
//            'toggleDataOptions' => [
//                'all' => [
//                    'icon' => 'resize-full',
//                    'label' => 'Показать все',
//                    'class' => 'btn btn-default',
//                    'title' => 'Показать все'
//                ],
//                'page' => [
//                    'icon' => 'resize-small',
//                    'label' => 'Страницы',
//                    'class' => 'btn btn-default',
//                    'title' => 'Постаничная разбивка'
//                ],
//            ],
//            'columns' => [
//                [
//                    'class' => DataColumn::class,
//                    'vAlign' => GridView::ALIGN_MIDDLE,
//                    'hAlign' => GridView::ALIGN_CENTER,
//                    'attribute' => 'id',
//                    'format' => 'raw',
//                    'width' => '70px',
//                ],
//                [
//                    'label' => 'Характеристика',
//                    'value' => function (Value $value) {
//                        return $value->characteristic->title;
//                    }
//                ],
//                [
//                    'label' => 'Значение',
//                    'value' => function (Value $value) {
//                        return $value->getText();
//                    }
//                ],
//                [
//                    'class' => ActionColumn::className(),
//                    'template' => '{update} {delete}',
//                    'noWrap' => true,
//                    'buttons' => [
//                        'update' => function ($url, Value $model, $key) {
//                            return Html::a(
//                                '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Редактировать',
//                                ['value/set', 'id' => $model->product_id, 'characteristicId' => $model->characteristic_id],
//                                ['class' => 'btn btn-primary btn-xs', 'data-pjax' => '0']);
//                        },
//                        'delete' => function ($url, $model, $key) {
//                            return Html::a('<i class="fa fa-trash" aria-hidden="true"></i>', [
//                                'value/delete',
//                                'productId' => $model->product_id,
//                                'valueId' => $model->id,
//
//                            ], [
//                                'class' => 'btn btn-danger btn-xs pjax-action',
//                                'data-pjax' => '0',
//                                'data-confirm' => 'Вы уверены?',
//                                'data-method' => 'post',
//                                'data-pjax-container' => 'pjax-values'
//                            ]);
//                        },
//                    ],
//                ],
//            ]
//        ]);
//        ?>
<!--    </div>-->
<!--</div>-->

