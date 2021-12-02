<?php

use app\modules\calculator\models\Calculator;
use app\modules\calculator\models\CalculatorCharacteristc;
use app\modules\calculator\models\CalculatorValue;
use kartik\grid\ActionColumn;
use kartik\grid\DataColumn;
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;
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

<div class="box box-default box-solid" id="test-values">
    <div class="box-header with-border">
        <h3 class="box-title">Значения</h3>
    </div>
    <div class="box-body">
        <p>
            <?= Html::a('Добавить значение', ['calculator-value/create', 'id' => $characteristic->id], ['class' => 'btn btn-success btn-xs', 'data-pjax' => '0']) ?>
        </p>
        <?= GridView::widget([
            'dataProvider' => new ArrayDataProvider(['models' => $characteristic->values]),
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
                    'value' => function (CalculatorValue $value) {
                        return
                            Html::a('<span class="glyphicon glyphicon-arrow-up"></span>',
                                [
                                    'calculator-value/move-up',
                                    'id' => $value->id
                                ],
                                [
                                    'class' => 'pjax-action',
                                ]) .
                            Html::a('<span class="glyphicon glyphicon-arrow-down"></span>',
                                [
                                    'calculator-value/move-down',
                                    'id' => $value->id
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
                [
                    'label' => 'Значение',
                    'value' => function (CalculatorValue $value) {
                        return $value->value;
                    }
                ],
                [
                    'label' => 'Цена',
                    'value' => function (CalculatorValue $value) {
                        return $value->price;
                    }
                ],
                [
                    'class' => ActionColumn::className(),
                    'template' => '{update} {delete}',
                    'noWrap' => true,
                    'buttons' => [
                        'update' => function ($url, CalculatorValue $model, $key) {
                            return Html::a(
                                '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Редактировать',
                                [
                                    'calculator-value/update',
                                    'valueId' => $model->id,
                                    'characteristicId' => $model->characteristic_id
                                ],
                                [
                                    'class' => 'btn btn-primary btn-xs',
                                    'data-pjax' => '0'
                                ]);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('<i class="fa fa-trash" aria-hidden="true"></i>', [
                                'calculator-value/delete',
                                'id' => $model->id,

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