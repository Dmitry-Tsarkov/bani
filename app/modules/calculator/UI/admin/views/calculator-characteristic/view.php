<?php

use app\modules\calculator\models\CalculatorCharacteristc;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/**
 * @var View $this
 * @var \app\modules\calculator\models\Calculator $calculator
 * @var CalculatorCharacteristc $characteristic
 */

$this->title = 'Калькулятор "' . $calculator->title . '"';
$this->params['breadcrumbs'] = [
    ['label' => 'Калькуляторы', 'url' => ['index']],
    ['label' => 'Калькулятор', 'url' => ['view'], 'id' => $calculator->id],
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
                'model' => $characteristic,
                'attributes' => [
                    'id',
                    [
                        'label' => 'Название',
                        'attribute' => 'title',
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
</div>