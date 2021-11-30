<?php

use app\modules\calculator\models\Calculator;
use app\modules\calculator\models\CalculatorCharacteristc;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/**
 * @var View $this
 * @var Calculator $calculator
 * @var CalculatorCharacteristc $characteristic
 */

$this->title = 'Калькулятор "' . $calculator->title . '"';
$this->params['breadcrumbs'] = [
    ['label' => 'Калькуляторы', 'url' => ['index']],
    $calculator->title
];
$this->title = $calculator->title;

?>

<p>
    <?= Html::a('Редактировать',
        [
            'update', 'calculatorId' => $calculator->id, 'characteristicId' => $characteristic->id
        ],
        [
            'class' => 'btn btn-primary btn-xs'
        ])
    ?>
</p>
<div class="row">
    <div class="col-xs-8">
        <div class="box box-default box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Общее</h3>
            </div>
            <?= DetailView::widget([
                'model' => $characteristic,
                'attributes' => [
                    'id',
                    [
                        'label' => 'Название',
                        'attribute' => 'title',
                    ],
                    [
                        'label' => 'Способ вывода',
                        'value' => function (CalculatorCharacteristc $characteristc) {
                            return $characteristc->getType();
                        }
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
</div>

<!--<div class="box box-default box-solid" id="test-values">-->
<!--    <div class="box-header with-border">-->
<!--        <h3 class="box-title">Характеристики</h3>-->
<!--    </div>-->
<!--    <div class="box-body">-->
<!--        <p>-->
<!--            --><? //= Html::a('Добавить значение', ['value/request', 'id' => $calculator->id], ['class' => 'btn btn-success', 'data-pjax' => '0']) ?>
<!--        </p>-->
<!--        --><? //= GridView::widget([
//            'dataProvider' => new ArrayDataProvider(['models' => $calculator->characteristics]),
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
////                [
////                    'class' => DataColumn::class,
////                    'vAlign' => GridView::ALIGN_MIDDLE,
////                    'hAlign' => GridView::ALIGN_CENTER,
////                    'value' => function (CalculatorCharacteristc $characteristic) {
////                        return
////                            Html::a('<span class="glyphicon glyphicon-arrow-up"></span>',
////                                [
////                                    'calculator-characteristic/move-up',
////                                    'id' => $characteristic->id
////                                ],
////                                [
////                                    'class' => 'pjax-action',
////                                ]) .
////                            Html::a('<span class="glyphicon glyphicon-arrow-down"></span>',
////                                [
////                                    'calculator-characteristic/move-down',
////                                    'id' => $characteristic->id
////                                ],
////                                [
////                                    'class' => 'pjax-action',
////                                ]);
////                    },
////                    'format' => 'raw',
////                    'width' => '60px',
////                ],
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
//                    'value' => function (CalculatorCharacteristc $characteristic) {
//                        return $characteristic->title;
//                    }
//                ],
//                [
//                    'class' => ActionColumn::className(),
//                    'template' => '{update} {delete}',
//                    'noWrap' => true,
//                    'buttons' => [
//                        'update' => function ($url, CalculatorCharacteristc $model, $key) {
//                            return Html::a(
//                                '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Редактировать',
//                                [
//                                    'calculator-characteristic/update',
//                                    'calculatorId' => $model->calculator_id,
//                                    'characteristicId' => $model->id
//                                ],
//                                [
//                                    'class' => 'btn btn-primary btn-xs',
//                                    'data-pjax' => '0'
//                                ]);
//                        },
//                        'delete' => function ($url, $model, $key) {
//                            return Html::a('<i class="fa fa-trash" aria-hidden="true"></i>', [
//                                'calculator-characteristic/delete',
//                                'calculatorId' => $model->calculator_id,
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
